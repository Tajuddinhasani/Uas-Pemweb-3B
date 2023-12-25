<?php
// sales/detail.php

$orderId = $_GET['id']; // Get the order ID from the URL parameter

// Fetch order details based on the order ID
$orderDetailQuery = "SELECT * FROM orders WHERE id = $orderId";
$orderDetailResult = mysqli_query($conn, $orderDetailQuery);

if ($orderDetail = mysqli_fetch_assoc($orderDetailResult)) {
    // Display order details as needed
    $productName = $orderDetail['nominal'];
    $paymentMethod = $orderDetail['payment_method'];
    $user_id = $orderDetail['user_id']; // Change this line to use user_id

    // Replace 'timestamp_column' with your actual timestamp column name
    $formattedTimestamp = date('Y-m-d H:i:s', strtotime($orderDetail['timestamp_column']));

    // Display order details here...
    echo "<h1>Order Detail: Penjualan $productName</h1>";
    echo "<p>Payment Method: $paymentMethod</p>";
    echo "<p>User ID: $user_id</p>"; // Change this line to display user_id
    echo "<p>Timestamp: $formattedTimestamp</p>";
} else {
    echo "Order not found.";
}
?>
