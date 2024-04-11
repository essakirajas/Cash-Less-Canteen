<?php
$Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
file_put_contents('UIDContainer.php', $Write);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        html {
            font-family: Arial;
            display: inline-block;
            margin: 0px auto;
            text-align: center;
        }
        body {
            background-color: #0000;
            color: black;
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
        }
        td.lf {
            padding-left: 15px;
            padding-top: 12px;
            padding-bottom: 12px;
        }
        .form-control{
            width : 250px;
        }
        .form-group{
            padding-left : 300px;
        }
    </style>

    <title>Landing page</title>
</head>

<body>
    <br>
    
    <!-- Input field for manually entering ID -->


    <br>

    <div id="show_user_data">
        <div class="container h-100" style="padding-top: 8%;">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="text-center">
                    <h1>Welcome FX Canteen</h1>
                    <img src="img/logo.png" alt="Logo" width="150" height="150"> <!-- Replace 'your-logo.png' with your actual logo image path -->
                </div>
            </div>
        </div>
    </div>
    <form method="get" action="dash.php">
        <div class="form-group">
            <label for="id">Enter ID:</label>
            <input type="text" class="form-control" id="id" name="id" placeholder="Enter ID" required><br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        
    </form>
    
    <br>
    <br>

    <script>
        var myVar = setInterval(myTimer, 1000);
        var myVar1 = setInterval(myTimer1, 1000);
        var oldID = "";
        clearInterval(myVar1);

        function myTimer() {
            var getID = document.getElementById("id").innerHTML;
            oldID = getID;
            if (getID != "") {
                myVar1 = setInterval(myTimer1, 500);
                showUser(getID);
                clearInterval(myVar);
            }
        }

        function myTimer1() {
            var getID = document.getElementById("id").innerHTML;
            if (oldID != getID) {
                myVar = setInterval(myTimer, 500);
                clearInterval(myVar1);
            }
        }

        function showUser(str) {
            if (str == "") {
                document.getElementById("show_user_data").innerHTML = "";
                return;
            } else {
                if (window.XMLHttpRequest) {
                    // Code for modern browsers
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // Code for old IE browsers
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.open(); // Clear the current document
                        document.write(this.responseText); // Write the response from "read_tag_user_data.php"
                        document.close(); // Close and display the new content
                    }
                };
                xmlhttp.open("GET", "dash.php?id=" + str, true); // Updated URL
                xmlhttp.send();
            }
        }

        var blink = document.getElementById('blink');
        setInterval(function () {
            blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
        }, 750);
    </script>

</body>
</html>
