<?php
require('../Function/config.php'); // Include your database configuration
require('../FPDF/fpdf.php'); // Path to your FPDF library

// Query to fetch sales data
$sql = "SELECT 
            p.ProductName, 
            SUM(oi.Quantity) AS ItemSold, 
            SUM(oi.Quantity * oi.Price) AS TotalRevenue
        FROM 
            order_items oi
        JOIN 
            product p ON oi.ProductID = p.ProductID
        GROUP BY 
            p.ProductName";
$result = $con->query($sql);

// Initialize FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Title
$pdf->Cell(0, 10, 'Sales Report', 0, 1, 'C');
$pdf->Ln(10); // Line break

// Column Headers
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(60, 10, 'Product Name', 1, 0, 'C');
$pdf->Cell(40, 10, 'Items Sold', 1, 0, 'C');
$pdf->Cell(60, 10, 'Total Revenue (RM)', 1, 1, 'C');

// Reset font for table content
$pdf->SetFont('Arial', '', 12);

// Check if there is data
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(60, 10, $row['ProductName'], 1);
        $pdf->Cell(40, 10, $row['ItemSold'], 1, 0, 'C');
        $pdf->Cell(60, 10, 'RM ' . number_format($row['TotalRevenue'], 2), 1, 1, 'R');
    }
} else {
    $pdf->Cell(0, 10, 'No sales data found', 1, 1, 'C');
}

// Output the PDF
$pdf->Output('D', 'Sales_Report.pdf'); // Download the PDF file

// Close the database connection
$con->close();
?>
