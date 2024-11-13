<?php
require('config.php');

// Check database connection
if (!$con) {
    die(json_encode(['error' => 'Database connection failed.']));
}

// Get the posted data
$data = json_decode(file_get_contents('php://input'), true);
$prices = $data['prices'] ?? []; // Use null coalescing operator to avoid undefined index notice

if (empty($prices)) {
    // No filter applied; fetch all products
    $query = "SELECT * FROM product";
} else {
    // Prepare a query based on selected prices
    $priceRanges = [
        'price-1' => "Price BETWEEN 1 AND 30",
        'price-2' => "Price BETWEEN 31 AND 60",
        'price-3' => "Price BETWEEN 61 AND 90",
        'price-4' => "Price BETWEEN 91 AND 120",
        'price-5' => "Price > 120"
    ];
    
    $conditions = [];
    foreach ($prices as $price) {
        if (isset($priceRanges[$price])) {
            $conditions[] = $priceRanges[$price];
        }
    }

    // Check if there are any valid conditions
    if (count($conditions) > 0) {
        $query = "SELECT * FROM product WHERE " . implode(' OR ', $conditions);
    } else {
        // If no valid conditions, fetch all products
        $query = "SELECT * FROM product";
    }
}

// Execute the query
$result = mysqli_query($con, $query);

// Check for query errors
if (!$result) {
    die(json_encode(['error' => 'Query failed: ' . mysqli_error($con)]));
}

// Fetch products
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Return the products as a JSON response
header('Content-Type: application/json');
echo json_encode($products);
?>