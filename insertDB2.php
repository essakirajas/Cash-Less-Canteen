<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track post values
        $order_id = $_POST['id'];
		$user_id = $_POST['id'];
		$roll_number = $_POST['roll'];
		$order_items = $_POST['name'];
        $total_amount = $_POST['id'];
        $order_time = $_POST['mobile'];
        
		// insert data
        $pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO order_details (order_id,id,roll_number,order_items,total_amount,order_time) values(?, ?,?, ?, ?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($order_id,$user_id,$roll_number,$order_items,$total_amount,$order_time));
		Database::disconnect();
		header("Location: user data.php");
    }
?>