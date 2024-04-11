<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = isset($_POST['userId']) ? $_POST['userId'] : null;
    $totalAmount = isset($_POST['totalAmount']) ? $_POST['totalAmount'] : 0;

    if ($userId === null) {
        // Handle invalid input or error
        echo 'failed';
        exit;
    }

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
        // Fetch the user's current balance
        $query = "SELECT balance FROM balance_amount WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$userId]);
        $row = $stmt->fetch();

        if ($row) {
            $currentBalance = $row['balance'];

            if ($currentBalance >= $totalAmount) {
                // Calculate the new balance after deducting the total amount
                $newBalance = $currentBalance - $totalAmount;

                // Update the user's balance in the database
                $updateQuery = "UPDATE balance_amount SET balance = ? WHERE id = ?";
                $updateStmt = $pdo->prepare($updateQuery);
                $updateStmt->execute([$newBalance, $userId]);

                // You can also insert the order details into the database here if needed

                echo 'success';
            } else {
                // User's balance is insufficient
                echo 'insufficient_balance';
            }
        } else {
            echo 'failed';
        }
    } catch (PDOException $e) {
        echo 'failed';
    }

    Database::disconnect();
    
}
