
<?php
require 'database.php';

$Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
file_put_contents('UIDContainer.php',$Write);

$id = $roll = $error = "";
$name = $gender = $email = $mobile = $balance = $add_amount = "";
$successMessage = ""; // Initialize success message

if (!empty($_POST)) {
    $id = isset($_POST['id']) ? $_POST['id'] : "";
    $roll = isset($_POST['roll']) ? $_POST['roll'] : "";
    $add_amount = isset($_POST['add_amount']) ? floatval($_POST['add_amount']) : 0; // Get the additional amount as a float

    if (!empty($id) || !empty($roll)) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            if (!empty($id)) {
                $sql = "SELECT t.id, t.roll, t.name, t.gender, t.email, t.mobile, b.balance
                        FROM table_the_iot_projects t
                        LEFT JOIN balance_amount b ON t.id = b.id
                        WHERE t.id = ?";
                $params = array($id);
            } elseif (!empty($roll)) {
                $sql = "SELECT t.id, t.roll, t.name, t.gender, t.email, t.mobile, b.balance
                        FROM table_the_iot_projects t
                        LEFT JOIN balance_amount b ON t.id = b.id
                        WHERE t.roll = ?";
                $params = array($roll);
            }

            $q = $pdo->prepare($sql);
            $q->execute($params);

            if ($q->rowCount() > 0) {
                $row = $q->fetch(PDO::FETCH_ASSOC);
                $id = $row['id'];
                $roll = $row['roll'];
                $name = $row['name'];
                $gender = $row['gender'];
                $email = $row['email'];
                $mobile = $row['mobile'];
                $balance = $row['balance'];

                $successMessage = "Balance updated successfully.";
            } else {
                $error = "No user found with the provided ID or Name.";
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }

        Database::disconnect();
    } else {
        $error = "Please enter ID or Name to fetch user details.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

		<script>
			$(document).ready(function(){
				 $("#getUID").load("UIDContainer.php");
				setInterval(function() {
					$("#getUID").load("UIDContainer.php");
				}, 500);
			});
		</script>
				<style>
        html {
            font-family: Arial;
            display: inline-block;
            margin: 0px auto;
            text-align: center;
        }
        
        textarea {
            resize: none;
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

        .center {
            margin: 0 auto;
            width: 495px;
            border-style: solid;
            border-color: #f2f2f2;
        }
        </style>
		
		<title>Cashless Canteen</title>
	</head>
	
	<body>
		<h2>Cashless Canteen</h2>
		<ul class="topnav">
        <li><a class="active" href="home.php">Home</a></li>
        <li><a href="user data.php">User Data</a></li>
        <li><a href="registration.php">Registration</a></li>
        <li><a href="read tag.php">Read Tag ID</a></li>
        <li><a href="Deposit.php">Deposit</a></li>
        <li><a href="Bill.php">Bill</a></li>
        <li><a href="order_history.php">Bill Desk</a></li>
		</ul>
		<br>
		<h3>Cashless Canteen</h3>

    <div class="container">
        <br>
        <div class="center" style="margin: 0 auto; width:495px; border-style: solid; border-color: #f2f2f2;">
            <div class="row">
                <h3 align="center">User Details</h3>
            </div>
            <br>
            <form class="form-horizontal" method="post">
                <div class="control-group">
                    <label class="control-label">ID</label>
                    <div class="controls">
                    <textarea name="id" id="getUID" placeholder="Please Scan your Card / Key Chain to display ID" rows="1" cols="1" ></textarea>
                    </div>
                </div>
                
                <div class="control-group">
                        <label class="control-label">Roll Number</label>
                        <div class="controls">
                            <input name="roll" type="text" value="<?php echo $roll; ?>">
                        </div>
                    </div>

                <!-- Add additional fields here -->
                

                <div class="form-actions">
                    <button type="submit" class="btn btn-success" name="update">Fetch Details</button>
                </div>
            </form>

            <?php if (empty($error)): ?>
                <h4>User Details:</h4>
                <form class="form-horizontal" method="post" action="insertDB1.php">
                <div class="control-group">
                    <label class="control-label">ID</label>
                    <div class="controls">
                        <input name="id" type="text" placeholder="Enter ID" value="<?php echo $id; ?>">
                    </div>
                </div>
                
                <div class "control-group">
                    <label class="control-label">Name</label>
                    <div class="controls">
                        <input name="name" id="name" type="text" placeholder="Enter Name" value="<?php echo $name; ?>">
                    </div>
                </div>
                    <div class="control-group">
                        <label class="control-label">Roll Number</label>
                        <div class="controls">
                            <input name="roll" type="text" value="<?php echo $roll; ?>" readonly>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Gender</label>
                        <div class="controls">
                            <select name="gender">
                                <option value="Male" <?php echo ($gender === 'Male') ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?php echo ($gender === 'Female') ? 'selected' : ''; ?>>Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Email Address</label>
                        <div class="controls">
                            <input name="email"id="email" type="text" value="<?php echo $email; ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Mobile Number</label>
                        <div class="controls">
                            <input name="mobile" id="num" type="text" value="<?php echo $mobile; ?>">
                        </div>
                    </div>

                    
                    <div class="control-group">
                        <label class="control-label">Balance Amount</label>
                        <div class="controls">
                            <input name="balance" type="text"  value="<?php echo $balance; ?>" >
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Amount to be added to Wallet</label>
                        <div class="controls">
                            <input name="add_amount" id="amount" type="text" value="<?php echo $add_amount; ?>">
                        </div>
                    </div>
                    <div class="form-actions">
                    <button type="submit" class="btn btn-success"  name="update">Save Changes</button>
                </div>
                
                </form>
                <button type="submit" class="btn btn-success" id="razorpayBtn">Razor Payment</button>
              
           
            <?php else: ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            
            <?php if (!empty($successMessage)): ?>
                <p style="color: green;"><?php echo $successMessage; ?></p>
            <?php endif; ?>
        </div>
    </div>
   


</body>
<script>

  function initiateRazorpayPayment() {
    var amount = parseInt($('#amount').val());
    var orderId = ''; // You need to generate the order_id on your server-side and pass it here
    var name = $('#name').val();
    var phoneNumber = $('#num').val();
    var email = $('#mail').val();

    var options = {
      key: "rzp_test_H0KqHhdAvOGByu", // Replace with your Razorpay API key
      amount: amount * 100, // Amount in paise, so multiply by 100
      currency: "INR",
      name: "FX Canteen Payment",
      description: "Payment for Orders",
      image: "your_logo_url.png",
      order_id: orderId,
      handler: function (response) {
        // Handle payment success
        var paymentId = response.razorpay_payment_id;
        console.log(paymentId);
        var orderId = response.razorpay_order_id;
        console.log(orderId);
        var signature = response.razorpay_signature;

        // Now, send the payment details along with the order_id, name, and phone number to the server-side for verification
        $.ajax({
          url: 'http://localhost:8080/WebApplication1/ProcessOrder.jsp', // Replace with the URL of your server-side processing page
          type: 'POST',
          data: {
            order_id: orderId,
            payment_id: paymentId,
            signature: signature,
            amount: amount,
            name: name,
            phone: phoneNumber,
            email: email
          },
          success: function (data) {
            // Handle the server-side response, e.g., show a success message to the user
          },
          error: function (xhr, status, error) {
            // Handle any errors, e.g., show an error message to the user
          }
        });
      },
      prefill: {
        name: name,
        email: email,
        contact: phoneNumber
      }
    };

    var rzp = new Razorpay(options);
    rzp.open();
  }

  // Attach a click event to the Razorpay payment button
  $('#razorpayBtn').click(function () {
    initiateRazorpayPayment();
  });
</script>

</html>
