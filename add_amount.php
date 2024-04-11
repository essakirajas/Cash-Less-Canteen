<?php
require 'database.php';

$id = $roll = $error = "";
$name = $gender = $email = $mobile = $balance = $add_amount = "";
$successMessage = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "ID not provided.";
    exit;
}

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['id']) || isset($_POST['roll'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : "";
    $roll = isset($_POST['roll']) ? $_POST['roll'] : "";
    $add_amount = isset($_POST['add_amount']) ? floatval($_POST['add_amount']) : 0;

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

        if (!empty($sql)) {
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

                // Check if the keys exist before accessing them
                if (isset($row['balance'])) {
                    $balance = $row['balance'];
                }

                $successMessage = "Balance updated successfully.";
            } else {
                $error = "No user found with the provided ID or Roll Number.";
            }
        }
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
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

Database::disconnect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
   body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h4 {
            color: #333;
        }

        .control-group {
            margin: 10px 0;
        }

        .btn-success {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
        }

        /* Responsive CSS Styles */
        @media (max-width: 768px) {
            h4 {
                font-size: 24px;
            }
            .control-group {
                margin: 8px 0;
            }
        }

        @media (max-width: 576px) {
            h4 {
                font-size: 20px;
            }
            .control-group {
                margin: 6px 0;
            }
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
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        FX Canteen
    </div>
<div class="container">
    <?php if (empty($error)): ?>
        <h4>User Details:</h4>
        <form class="form-horizontal" method="post" action="insertDB1.php">
            <div class="control-group">
                <label class="control-label">ID</label>
                <div class="controls">
                    <input name="id" type="text" placeholder="Enter ID" value="<?php echo $id; ?>" readonly>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Name</label>
                <div class="controls">
                    <input name="name" id="name" type="text" placeholder="Enter Name" value="<?php echo $data['name']; ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Roll Number</label>
                <div class="controls">
                    <input name="roll" type="text" value="<?php echo $data['roll']; ?>" readonly>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Gender</label>
                <div class="controls">
                    <input name="gender" id="gender" type="text" value="<?php echo $data['gender']; ?>" readonly>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Email Address</label>
                <div class="controls">
                    <input name="email" id="email" type="text" value="<?php echo $data['email']; ?>" readonly>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Mobile Number</label>
                <div class="controls">
                    <input name="mobile" id="mobile" type="text" value="<?php echo $data['mobile']; ?>" readonly>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Balance Amount</label>
                <div class="controls">
                    <input name="balance" id="balance" type="text" value="<?php echo $data['balance']; ?>" readonly>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Amount to be added to Wallet</label>
                <div class="controls">
                    <input name="add_amount" id="amount" type="text" value="<?php echo $add_amount; ?>">
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-success" name="update">Save Changes</button>
            </div>
        </form>
        <button type="button" id="razorpayBtn" class="btn btn-success">Razorpay Payment</button>
    <?php else: ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if (!empty($successMessage)): ?>
        <p style="color: green;"><?php echo $successMessage; ?></p>
    <?php endif; ?>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
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

</body>
</html>
