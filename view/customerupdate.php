
<?php
session_start();
if (isset($_SESSION['email'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Profile</title>
        <link rel="stylesheet" href="../assets/css/style.css?v2.0">
    </head>

    <body>
        <?php
        include_once "../layout/header.php";
        //print_r($_SESSION); // You can enable this for debugging
        ?>
        
                <h3>My Profile</h3>
                <form method="POST" action="../control/customer_controller.php?action=update" enctype="multipart/form-data">
                    <label>Name:</label>
                    <input type="text" name="name" value="<?= $_SESSION['name'] ?? '' ?>" />
                    <br />
                    <label>Phone:</label>
                    <input type="text" name="phone" value="<?= $_SESSION['phone'] ?? '' ?>" />
                    <br />
                    <label>Gender:</label>
                    <select name="gender">
                        <option value="Male" <?php if (($_SESSION['gender'] ?? '') == 'Male') echo 'selected'; ?>>Male</option>
                        <option value="Female" <?php if (($_SESSION['gender'] ?? '') == 'Female') echo 'selected'; ?>>Female</option>
                        <option value="Other" <?php if (($_SESSION['gender'] ?? '') == 'Other') echo 'selected'; ?>>Other</option>
                    </select><br />
                    <label>Pet:</label>
                    <input type="text" name="pet" value="<?= $_SESSION['pet'] ?? '' ?>" />
                    <br />
                    <label>DOB:</label>
                    <input type="date" name="dob" value="<?= htmlspecialchars($_SESSION['dob'] ?? '') ?>" />
                    <br />
                    
                    
                    <label>Profile Picture:</label>
                    <img src="<?php echo $_SESSION['profile_picture']; ?>" alt="No pic" style="max-width:150px; height:auto;">

                    <input type="file" name="profile_picture" accept="image/*" />
                    <input type="hidden" name="old_profile_picture" value="<?= htmlspecialchars($_SESSION['profile_picture'] ?? '') ?>" /></br>
                     <br/>
                    <button type="submit" class="button green">Update Profile</button>
                </form>
                <br />
                
                <a href="customerDashboard.php" class="button green">Back to Dashboard</a>
            
        <!--------------------- Profile End ----------------------------->
        <?php include 'footer.php'; ?>
    </body>

    </html>
<?php
} else {
    header("Location:../view/login.php");
    exit();
}
?>