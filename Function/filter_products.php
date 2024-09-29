<?php
require('config.php');

// Get the posted data
$data = json_decode(file_get_contents('php://input'), true);
$prices = $data['prices'];

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

    $query = "SELECT * FROM product WHERE " . implode(' OR ', $conditions);
}

$result = mysqli_query($con, $query);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Return the products as a JSON response
header('Content-Type: application/json');
echo json_encode($products);
?>