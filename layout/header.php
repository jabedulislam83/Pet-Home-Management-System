<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pet Daycare</title>
    <link rel="stylesheet" href="../css/mystyle.css">
</head>
<body>
    <header>
        <h1>🐾 Pet Daycare System</h1>
        <nav>
            <?php if (isset($_SESSION['customer_id'])): ?>
                <a href="customerprofile.php">Dashboard</a> |
            <?php elseif (isset($_SESSION['manager_id'])): ?>
                <a href="managerprofile.php">Dashboard</a> |
            <?php elseif (isset($_SESSION['employee_id'])): ?>
                <a href="employeeprofile.php">Dashboard</a> |
            <?php endif; ?>
            <a href="../control/logout.php">Logout</a>
        </nav>
        <hr>
    </header>
