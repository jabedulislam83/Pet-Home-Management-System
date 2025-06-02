<?php include('../layout/header.php'); ?>
<h2>Customer Login</h2>
<form action="../control/customerlogincontrol.php" method="POST">
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Login">
</form>
<?php include('../layout/footer.php'); ?>