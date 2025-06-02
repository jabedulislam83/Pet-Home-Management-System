<?php
session_start();
$cookies_enabled = (count($_COOKIE) > 0);
?>
<html>
<head>
    <title>Pet Daycare Home</title>
    <link rel="stylesheet" href="../css/mystyle.css">
</head>
<body>
    <h1 class="header big red">Pet Daycare</h1>
    <h1 class="header small yellow">Welcome</h1>
    <div class="menu">
        <a href="signup.php"><button class="submit">Sign Up</button></a>
        <a href="employeelogin.php"><button class="submit">Login</button></a>
    </div>
</body>
</html>
