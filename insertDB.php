<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track post values
        $name = $_POST['name'];
		$id = $_POST['id'];
		$roll = $_POST['roll'];
		$gender = $_POST['gender'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
		$password = $_POST['password'];
        
		// insert data
        $pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO table_the_iot_projects (name,id,roll,gender,email,mobile,password) values(?, ?,?, ?, ?, ?,?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($name,$id,$roll,$gender,$email,$mobile,$password));
		Database::disconnect();
		header("Location: user data.php");
    }
?>