<?php
require('fpdf/fpdf.php');
include 'config.php';

// Check if the order ID is provided
if(isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Fetch the order details from the database based on the order ID
    $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE id = '$order_id'") or die('Query failed');
    $fetch_order = mysqli_fetch_assoc($order_query);

    // Generate the receipt PDF
    $pdf = new FPDF();

    // Add a page to the PDF
    $pdf->AddPage();

    // Set the font and font size for "Medly"
    $pdf->SetFont('Arial', '', 24);
    // Set the color for "Medly"
    $pdf->SetTextColor(128, 0, 128); // RGB: (128, 0, 128) - purple

    // Add content to the PDF
    $pdf->Cell(0, 10, 'Medly', 0, 1, 'C');
    $pdf->Ln(10);
    
    // Reset the font and color settings
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(0, 0, 0); // Reset color to black

    // Order Info
    $pdf->Cell(0, 10, '', 0, 1); // Empty line for spacing
    $pdf->Cell(120); // Move to the right for order ID
    $pdf->Cell(50, 10, 'Order ID:', 0, 0);
    $pdf->Cell(0, 10, $fetch_order['id'], 0, 1);

    // Customer Info
    $pdf->Cell(50, 10, 'Name:', 0, 0);
    $pdf->Cell(0, 10, $fetch_order['name'], 0, 1);
    $pdf->Cell(50, 10, 'Number:', 0, 0);
    $pdf->Cell(0, 10, $fetch_order['number'], 0, 1);
    $pdf->Cell(50, 10, 'Email:', 0, 0);
    $pdf->Cell(0, 10, $fetch_order['email'], 0, 1);
    $pdf->Cell(50, 10, 'Address:', 0, 0);
    $pdf->MultiCell(0, 10, $fetch_order['address'], 0, 'L');
    $pdf->Ln(10);

    

    // Total Products and Total Price
    $pdf->Cell(0, 10, '', 0, 1); // Empty line for spacing
    $pdf->Cell(50, 10, 'Total Products:', 0, 0);
    $products = explode(',', $fetch_order['total_products']); // Split the products by comma
    $products = array_slice($products, 1); // Remove the first element (comma)
    $pdf->MultiCell(0, 10, '' . implode("\n", $products), 0, 'L');
    $pdf->Cell(50, 10, 'Total Price:', 0, 0);
    $pdf->Cell(0, 10, $fetch_order['total_price'].'/-'." Taka", 0, 1);
    $pdf->Ln(10);

    // Thank You Statement
    $pdf->Cell(0, 10, '', 0, 1); // Empty line for spacing
    $pdf->MultiCell(0, 10, 'Thank you for ordering from Medly. We offer a 7-day return/refund policy on all products. If you have any complaint about this order, please call us at 01*-***-***** or email us at support@medly.com', 0, 'L');

    // Output the PDF as a download
    $pdf->Output('receipt.pdf', 'D');
} else {
    // Order ID not provided, redirect to a suitable page
    header('location: orders.php');
    exit();
}
?>
