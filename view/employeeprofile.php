<?php
session_start();
if (!isset($_SESSION["employee_id"])) {
    header("Location: employeelogin.php");
    exit();
}
?>

<html>
<head><title>Employee Profile</title></head>
<body>
    <h1>Welcome, <?php echo $_SESSION["employee_name"]; ?>!</h1>
    <p>Email: <?php echo $_SESSION["employee_email"]; ?></p>
    <img src="../control/upload/<?php echo $_SESSION["employee_photo"]; ?>" width="150" alt="Profile Photo">
    <br><br>
    <div class="dashboard-options">
        <a href="employeeupdate.php"><button class="update">Update Profile</button></a>
        <a href="../control/delete_employee.php"><button class="delete">Delete Page</button></a>
        <a href="../control/logout.php"><button class="reset">Logout</button></a>
    </div>
</body>
</html>
