<?php
    require 'database.php';
    $id = "null";
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    $pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT t.id, t.roll, t.name, t.gender, t.email, t.mobile, b.balance
	FROM table_the_iot_projects t
	LEFT JOIN balance_amount b ON t.id = b.id
	WHERE t.id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();
	
	$msg = null;
	if (null==$data['name']) {
		$msg = "The ID of your Card / KeyChain is not registered !!!";
		$data['id']=$id;
		$data['name']="--------";
		$data['gender']="--------";
		$data['email']="--------";
		$data['mobile']="--------";
	} else {
		$msg = null;
	}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f0f0;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }
        .header {
            text-align: center;
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
        .user-details, .balance-box {
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .balance-box {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
			height:180px;
			font-size: 25px;
        }
        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .msg {
            color: red;
            text-align: center;
        }
        .button-container {
            margin-top: 20px;
        }
		.text-center{
			padding-top : 30px;
        }
            ul.topnav {
            list-style-type: none;
            margin: auto;
            padding: 0;
            overflow: hidden;
            background-color: #4CAF50;
            width: 70%;
        }
        ul.topnav li {float: left;}
        ul.topnav li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        ul.topnav li a:hover:not(.active) {background-color: #3e8e41;}
        ul.topnav li a.active {background-color: #333;}
        ul.topnav li.right {float: right;}
        @media screen and (max-width: 600px) {
            ul.topnav li.right, 
            ul.topnav li {float: none;}
        }padding-left : 20px;
		}
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        FX Canteen
    </div>
    <ul class="topnav">
        <li><a href="add_amount.php">Deposit</a></li>
        <li><a href="bill2.php">Bill</a></li>
        <li><a href="recent_recipt.php">Bill Desk</a></li>
    </ul>
    <br>
    <form>
        <div class="row">
            <div class="col-md-7">
                <div class="user-details">
                    <b>ID:</b> <?php echo $data['id']; ?><br>
                    <b>Name:</b> <?php echo $data['name']; ?><br>
					<b>Roll No:</b> <?php echo $data['roll']; ?><br>
                    <b>Gender:</b> <?php echo $data['gender']; ?><br>
                    <b>Email:</b> <?php echo $data['email']; ?><br>
                    <b>Mobile Number:</b> <?php echo $data['mobile']; ?><br>
                </div>
            </div>
            <div class="col-md-5">
                <div class="balance-box">
					<br>
					
                    <b>Balance:</b> <?php echo $data['balance']; ?>
                </div>
            </div>
        </div>
        <div class="text-center">
		<button type="button" class="btn btn-primary" id="addAmountButton">Add Amount</button>
		<button type="button" class="btn btn-primary" id="tokenGenerationBtn">Token Generation</button>
        <button type="button" class="btn btn-primary" id="recentreciptBtn">Recent Recipt</button>
        </div>
    </form>
    </div>
		<p style="color:red;"><?php echo $msg;?></p>
		<script>
		var id = <?php echo $id; ?>;
        document.getElementById('addAmountButton').addEventListener('click', function() {
            // Redirect to the add_amount.php page with the id as a query parameter
            window.location.href = "add_amount.php?id=" + id;
        });
        document.getElementById('tokenGenerationBtn').addEventListener('click', function() {
            // Redirect to the add_amount.php page with the id as a query parameter
            window.location.href = "bill2.php?id=" + id;
        });
        document.getElementById('recentreciptBtn').addEventListener('click', function() {
            // Redirect to the add_amount.php page with the id as a query parameter
            window.location.href = "recent_recipt.php?id=" + id;
        });
    </script>
</body>
</html>