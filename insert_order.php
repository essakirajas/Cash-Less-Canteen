<?php
// Include your database connection code here
require 'database.php';

// Get the order data sent via POST
$user_id = isset($_POST['userId']) ? $_POST['userId'] : '';
$roll_number = isset($_POST['roll_number']) ? $_POST['roll_number'] : '';
$order_items = isset($_POST['order_items']) ? $_POST['order_items'] : '';
$total_amount = isset($_POST['total_amount']) ? $_POST['total_amount'] : '';
$order_time = isset($_POST['order_time']) ? $_POST['order_time'] : '';

// Insert the order details into the database
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $sql = "INSERT INTO order_details (user_id, roll_number, order_items, total_amount, order_time)
            VALUES (?, ?, ?, ?, ?)";
    $params = array($user_id, $roll_number, $order_items, $total_amount, $order_time);

    $q = $pdo->prepare($sql);
    $q->execute($params);

    echo 'success'; // Return success message to the AJAX request
} catch (PDOException $e) {
    echo 'error'; // Return error message to the AJAX request
}

// Close the database connection
Database::disconnect();
?>
