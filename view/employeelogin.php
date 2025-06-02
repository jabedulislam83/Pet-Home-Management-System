<?php
session_start();
$cookies_enabled = (count($_COOKIE) > 0);
?>
<html>
<head>
    <title>Employee Login</title>
    <link rel="stylesheet" href="../css/mystyle.css">
</head>
<body>
    <h1 class="header">Employee Login</h1>

    <form action="../control/employeelogincontrol.php" method="post">
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Login" class="submit">
    </form>

    <p>Don't have an account? <a href="employeereg.php">Register here</a></p>
</body>
</html>
