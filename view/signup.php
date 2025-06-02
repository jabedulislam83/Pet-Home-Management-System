<?php
session_start();
$cookies_enabled = (count($_COOKIE) > 0);
?>
<html>
<head>
    <title>Sign Up Options</title>
    <link rel="stylesheet" href="../css/mystyle.css">
</head>
<body>
    <h1 class="header">Choose Account Type</h1>
    <div class="signup-options">
        <a href="employeereg.php"><button class="submit">Employee Sign Up</button></a>
        <a href="customersignup.php"><button class="submit">Customer Sign Up</button></a>
    </div>

    <p>Already have an account?</p>
    <div class="signup-options">
        <a href="employeelogin.php"><button class="submit">Employee Login</button></a>
        <a href="customerlogin.php"><button class="submit">Customer Login</button></a>
    </div>
</body>
</html>
