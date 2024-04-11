<?php
require 'database.php';

$id = $roll = $error = "";
$name = $gender = $email = $mobile = $balance = $add_amount = "";
$successMessage = ""; // Initialize success message

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
    $add_amount = isset($_POST['add_amount']) ? floatval($_POST['add_amount']) : 0; // Get the additional amount as a float

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
                $balance = $row['balance'];

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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.1/html2pdf.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf-lib/1.6.0/pdf-lib.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.72/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.2.1/html2canvas.min.js"></script>
    <title>Document</title>

    <style>
    /* Reset default margin and padding for consistency */
    * {
        margin: 0;
        padding: 0;
    }

    /* Main container */
    body {
        font-family: Arial, sans-serif;
        display: block;
        margin: 0 auto;
        text-align: center;
    }

    /* Navigation bar styles */
    ul.topnav {
        list-style-type: none;
        margin: auto;
        padding: 0;
        overflow: hidden;
        background-color: #4CAF50;
        width: 70%;
    }

    ul.topnav li {
        float: left;
    }

    ul.topnav li a {
        display: block;
        color: white;
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

    ul.topnav li.right {
        float: right;
    }

    @media screen and (max-width: 600px) {
        ul.topnav li.right,
        ul.topnav li {
            float: none;
        }
    }

    /* Page heading */
    h2 {
        font-family: Arial, sans-serif;
        text-align: center;
        color: #333;
    }

    /* Form styles */
    .form-horizontal {
        max-width: 400px;
        margin: 0 auto;
    }

    .control-group {
        margin-bottom: 20px;
    }

    .control-label {
        font-weight: bold;
    }

    .controls {
        display: block;
        margin-top: 5px;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    .form-actions {
        text-align: center;
    }

    .btn-success {
        background-color: #4CAF50;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-success:hover {
        background-color: #45a049;
    }

    /* Amount boxes for adding balance */
    .amount-box {
        border: 2px solid #000;
        padding: 10px;
        margin: 10px;
        cursor: pointer;
    }

    /* User balance section */
    .user-balance {
        text-align: center;
        margin-top: 15px;
    }

    .balance-amount {
        font-size: 24px;
        color: #333;
    }

    /* Receipt and table styles */
    .p-4 {
        padding: 4%;
    }

    #receipt_bill {
        margin-top: 20px;
    }

    #receipt_bill th {
        text-align: center;
    }

    #receipt_bill td {
        padding: 10px;
    }

    /* Total Amount display */
    #totalAmount {
        font-size: 24px;
        color: #333;
    }
    textarea {
            width :150px;
			resize: none;
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

		
		<title>Cashless Canteen</title>

</head>
<body>
<div class="container">
    <div class="header">
        FX Canteen
    </div>


<section class="mt-3">
    <div class="container-fluid">
    <div class="form-horizontal">
    <div class="row">
        <div class="col-md-6">
        <p>Name :</p>
                <p class="balance-amount"><?php echo $data['name']; ?></p>
        </div>
        <div class="col-md-6">
            <div class="user-balance">
                <p>Available Balance:</p>
                <p class="balance-amount">₹ <?php echo $data['balance']; ?></p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-5">
        <div class="amount-box" data-amount="5">Add Rs 5</div>
        <div class="amount-box" data-amount="10">Add Rs 10</div>
        <div class="amount-box" data-amount="20">Add Rs 20</div>
        <div class="amount-box" data-amount="50">Add Rs 50</div>
        <div class="amount-box" data-amount="100">Add Rs 100</div>
        <div class="amount-box" data-amount="200">Add Rs 200</div>
    </div>
    <div id="pdfContent">
    <div class="col-md-7" style="background-color: #f5f5f5;">
        <div class="p-4">
            <div class="text-center">
                <h4>Receipt</h4>
            </div>
            <span class="mt-4"> Time: <span class="mt-4" id="time"></span></span>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <span id="day"></span> : <span id="year"></span>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>Order No:  <?php
                    $timestamp = time(); // Get the current timestamp
                    $randomNumber = rand(1000, 9999); // Generate a random 4-digit number
                    
                    $orderNumber = "ORD-" . $timestamp . "-" . $randomNumber; // Combine timestamp and random number
                    
                    echo $orderNumber; // Output the unique order number
                    ?>
                    </p>
                </div>
            </div>
            <!-- Display user details here -->
            <div class="row">
    <p style="padding-right: 40px;">Name: <?php echo $name; ?></p>
    <p style="padding-right: 40px;">Email: <?php echo $email; ?></p>
    <p style="padding-right: 40px;">Roll: <?php echo $roll; ?></p>
    <p style="padding-right: 40px;">ID: <?php echo $id; ?></p>
</div>

            <div class="row">
                <!-- Content goes here -->
            </div>
            <table id="receipt_bill" class="table">
                <thead>
                    <tr>
                        <th> No.</th>
                        <th>Denomination (Rs)</th>
                        <th class="text-center">Total Amount</th>
                    </tr>
                </thead>
                <tbody id="new">
                    <!-- Table rows go here -->
                </tbody>
                <tr>
                    <td> </td>
                    <td> </td>
                    <td class="text-right text-dark">
                        <h5><strong>Total Amount: ₹ </strong></h5>
                    </td>
                    <td class="text-center text-dark">
                        <h5> <strong><span id="totalAmount"></span></strong></h5>
                    </td>
                </tr>
            </table>
            <input type="hidden" id="totalOrderAmount" value="0">
            <div class="form-actions">
                <button type="button" class="btn btn-success" id="placeOrderBtn">Place Order</button>
                <button type="button" class="btn btn-success" id="generatePdfButton">Generate PDF</button>
            </div>
        </div>
    </div>
</div>
<!-- Logout button -->
<div class="container text-center mt-4">
    <a href="recent_recipt.php" class="btn btn-primary">Recipt</a>
</div>
    </div>
</section>
</body>
</html>

<script>
        document.getElementById("generatePdfButton").addEventListener("click", async () => {
    // Get the HTML content of the #pdfContent element
    const content = document.getElementById("pdfContent");

    // Convert the HTML content to a canvas
    const canvas = await html2canvas(content);

    // Convert the canvas to a data URL
    const dataUrl = canvas.toDataURL();

    // Create a PDF definition using pdfmake
    const pdfDefinition = {
        content: [{
            image: dataUrl,
            width: 500, // Adjust the width as needed
        }]
    };

    // Create and open a PDF document
    pdfMake.createPdf(pdfDefinition).open();
});

    $(document).ready(function () {
        var count = 1;
        var totalAmount = 0; // Initialize totalAmount

        // Event listener for adding amounts to the receipt
        $('.amount-box').on('click', function () {
            var amount = $(this).data('amount');
            addAmountToBill(amount);
        });

        // Function to add the selected amount to the bill
        function addAmountToBill(amount) {
            var table = '<tr><td>' + count + '</td><td>' + amount + '</td><td>' + (amount * count) + '</td></tr>';
            $('#new').append(table);
            
            // Update totalAmount
            totalAmount += (amount);
            $('#totalAmount').text(totalAmount.toFixed(2));
           

            count++;
        }
       
        // Code for year
        var currentdate = new Date();
        var datetime = currentdate.getDate() + "/"
            + (currentdate.getMonth() + 1) + "/"
            + currentdate.getFullYear();
        $('#year').text(datetime);

        // Code for extract Weekday
        function myFunction() {
            var d = new Date();
            var weekday = new Array(7);
            weekday[0] = "Sunday";
            weekday[1] = "Monday";
            weekday[2] = "Tuesday";
            weekday[3] = "Wednesday";
            weekday[4] = "Thursday";
            weekday[5] = "Friday";
            weekday[6] = "Saturday";
            var day = weekday[d.getDay()];
            return day;
        }

        var day = myFunction();
        $('#day').text(day);

        // Code for TIME
        window.onload = displayClock();

        function displayClock() {
            var time = new Date().toLocaleTimeString();
            document.getElementById("time").innerHTML = time;
            setTimeout(displayClock, 1000);
        }
    });

    $(document).ready(function () {
    $('#placeOrderBtn').on('click', function () {
       
        var userId = <?php echo $id; ?>; // User's ID
        // var totalAmount = parseFloat($('#totalOrderAmount').val()); // Get the total amount from the hidden input
        var totalAmountElement = document.getElementById('totalAmount');
        var totalAmount = parseFloat(totalAmountElement.textContent);

        var orderItems = [];
        $('#receipt_bill tbody tr').each(function (index, row) {
            var columns = $(row).find('td');
            var denomination = parseFloat($(columns[1]).text());
            orderItems.push({
                item: 'Denomination (Rs)',
                price: denomination
            });
        });

        // Calculate the total amount
        var totalAmountElement = document.getElementById('totalAmount');
        var totalAmount = parseFloat(totalAmountElement.textContent);

        // Get the current date and time
        var orderTime = new Date().toISOString().slice(0, 19).replace('T', ' ');

        // Create a data object to send via AJAX
        var orderData = {
            userId: userId,
            roll_number: '<?php echo $roll; ?>',
            order_items: JSON.stringify(orderItems),
            total_amount: totalAmount,
            order_time: orderTime
        };



        // Send an AJAX request to place_order.php to deduct the total amount
        $.ajax({
            url: 'place_order.php',
            type: 'POST',
            data: {
                userId: userId,
                totalAmount: totalAmount, // Pass the total amount
            },
            success: function (response) {
                if (response === 'success') {
                    // Deduction successful
                    alert('Order placed successfully. Total Amount deducted: ₹' + totalAmount);
                    // You may want to update the UI or clear the receipt here.
                    $.ajax({
            url: 'insert_order.php', // Replace with your PHP script for inserting orders
            type: 'POST',
            data: orderData,
            success: function (response) {
                if (response === 'success') {
                    // Order insertion successful
                    alert('Order placed successfully.');
                    // You may want to update the UI or clear the receipt here.
                } else {
                    alert('Failed to place the order.');
                }
            },
            error: function () {
                alert('An error occurred while processing your order.');
            }
        });
                } else {
                    alert('Failed to place the order or deduct the amount.');
                }
            },
            error: function () {
                alert('An error occurred while processing your order.');
            }
        });
    

    });
});

</script>