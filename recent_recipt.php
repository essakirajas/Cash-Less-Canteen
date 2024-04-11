<?php
require 'database.php';


$user_id = "";
$latestOrder = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "ID not provided.";
    exit;
}

if (isset($_POST['fetch_orders'])) {
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : "";

    if (!empty($user_id)) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $sql = "SELECT * FROM order_details WHERE user_id = ? AND deliverd = 0";
            $q = $pdo->prepare($sql);
            $q->execute(array($user_id));
            $latestOrder = $q->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        Database::disconnect();
    }
}

// Process the "Delivered" button clic
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 10px;
            padding: 0;
            text-align : center;

        }
        h2 {
            color: #333;
        }
        .container {
            
            margin: 20px;
            margin-left :200px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width : 1300px;
            box-shadow: 0 2px 5px #ccc;
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #333;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #333;
            color: #fff;
        }
        .order-details {
            font-size: 14px;
            margin: 20px 0;
        }
        .order-details strong {
            font-size: 16px;
        }
        .receipt {
            border: 1px solid #333;
            padding: 20px;
        }
        textarea {
            width: 150px;
            resize: none;
        }
        html {
            font-family: Arial;
            display: inline-block;
            margin: 0px auto;
            text-align: center;
        }

        ul.topnav {
            list-style-type: none;
            margin: auto;
            padding: 0;
            overflow: hidden;
            background-color: #E9F1FA; /* Light blue */
            width: 70%;
        }

        ul.topnav li {float: left;}

        ul.topnav li a {
            display: block;
            color: #00ABE4; /* Bright blue */
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        ul.topnav li a:hover:not(.active) {
            background-color: #00ABE4; /* Bright blue */
            color: #FFFFFF; /* White */
        }

        ul.topnav li a.active {
            background-color: #333; /* Dark gray */
            color: #FFFFFF; /* White */
        }

        ul.topnav li.right {float: right;}

        @media screen and (max-width: 600px) {
            ul.topnav li.right, 
            ul.topnav li {float: none;}
        }
        
        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        body {
            background-color: #E9F1FA; /* Light blue */
        }
		ul.topnav {
            list-style-type: none;
            margin: auto;
            padding: 0;
            overflow: hidden;
            background-color: #00ABE4; /* Bright blue */
            width: 70%;
        }

        ul.topnav li {float: left;}

        ul.topnav li a {
            display: block;
            color: #FFFFFF; /* White */
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        ul.topnav li a:hover:not(.active) {
            background-color: #3e8e41;
        }

        ul.topnav li a.active {
            background-color: #333;
        }

        ul.topnav li.right {float: right;}

        @media screen and (max-width: 600px) {
            ul.topnav li.right,
            ul.topnav li {float: none;}
        }
    </style>
    <!-- Include other necessary CSS and JavaScript files here -->
    <title>Order History</title>
</head>
<body>
<h2>FX Canteen</h2>
    <ul class="topnav">
    <li><a href="add_amount.php">Deposit</a></li>
        <li><a href="bill2.php">Bill</a></li>
        <li><a href="recent_recipt.php">Bill Desk</a></li>
    </ul>
    <br>
    <div class="container">
        <h2>Latest Order</h2>
        <form method="post">
        <textarea name="user_id" id="getUID" placeholder="Please Scan your Card / Key Chain to display ID" rows="1" cols="1"  required></textarea> 
            <button type="submit" name="fetch_orders">Fetch Latest Order</button>
        </form>

        <?php
        if ($latestOrder) {
            echo "<div class='receipt'>";
            echo "<h3>Receipt</h3>";
            echo "<div class='order-details'>";
            echo "<strong>Order ID:</strong> " . $latestOrder['order_id'] . "<br>";
            echo "<strong>User ID:</strong> " . $latestOrder['user_id'] . "<br>";
            echo "<strong>Roll Number:</strong> " . $latestOrder['roll_number'] . "<br>";
            echo "<strong>Order Time:</strong> " . $latestOrder['order_time'] . "<br>";
            echo "<strong>Delivered:</strong> ";
            if ($latestOrder['deliverd']) {
                echo "Yes";
            } else {
                echo "No";
            }
            echo "</div>";

            echo "<table>";
            echo "<tr><th>Item</th><th>Quantity</th><th>Price</th></tr>";
            // Process order items if available
            $orderItems = json_decode($latestOrder['order_items'], true);
            if (is_array($orderItems)) {
                foreach ($orderItems as $item) {
                    echo "<tr>";
                    echo "<td>" . $item['item'] . "</td>";
                    if (isset($item['quantity'])) {
                        echo "<td>" . $item['quantity'] . "</td>";
                    } else {
                        echo "<td>N/A</td>"; // Or handle the case where 'quantity' is not defined
                    }
                    echo "<td>" . $item['price'] . "</td>";
                    echo "</tr>";
                }
                
            }
            echo "</table>";

            echo "<div class='order-details'>";
            echo "<strong>Total Amount:</strong> ₹" . $latestOrder['total_amount'];
            echo "</div>";

            echo "<form method='post'>";
            echo "<input type='hidden' name='order_id' value='" . $latestOrder['order_id'] . "'>";
            echo "</form>";
            echo "</div>";
        } elseif (isset($_POST['fetch_orders'])) {
            echo "No orders found for this user.";
        }
        ?>
    </div>
</body>
</html>
