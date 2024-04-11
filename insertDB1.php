<?php
require 'database.php';

$add_amount = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $id = $_POST['id'];
    $roll = $_POST['roll'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $balance = $_POST['balance'];
    $add_amount = $_POST['add_amount'];

    // Connect to the database
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve the current balance
    $sql = "SELECT balance FROM balance_amount WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $row = $q->fetch(PDO::FETCH_ASSOC);
    $current_balance = $row['balance'];

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO balance_amount (name,id,roll,gender,email,mobile) values(?, ?,?, ?, ?, ?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($name,$id,$roll,$gender,$email,$mobile));

    // Calculate the new balance by adding the additional amount
    $new_balance = $current_balance + $add_amount;

    // Update the balance in the database
    $updateSql = "UPDATE balance_amount SET balance = ? WHERE id = ?";
    $updateParams = array($new_balance, $id);
    $updateQuery = $pdo->prepare($updateSql);
    $updateQuery->execute($updateParams);

    // Update the user details
    $userUpdateSql = "UPDATE balance_amount SET name = ?, roll = ?, gender = ?, email = ?, mobile = ? WHERE id = ?";
    $userUpdateParams = array($name, $roll, $gender, $email, $mobile, $id);
    $userUpdateQuery = $pdo->prepare($userUpdateSql);
    $userUpdateQuery->execute($userUpdateParams);

    // Disconnect from the database
    Database::disconnect();
    
    $successMessage = "Amount added to the wallet and user details updated successfully.";
}

header("Location: read tag.php"); // Redirect back to your original page
?>
