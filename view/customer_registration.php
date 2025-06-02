 <?php include('../layout/header.php'); ?>
<h2>Customer Registration</h2>
<form action="../control/customer_controller.php?action=register" method="POST" enctype="multipart/form-data">

    <label>Name:</label><input type="text" name="name" id="sname" /><span id="snameErr"></span><br/>
    <label>Email:</label><input type="email" name="email" id="semail" /><span id="semailErr"></span><br/>
    <label>Phone:</label><input type="text" name="phone" id="sphone" /><span id="sphoneErr"></span><br/>
    <label>Gender:</label>
<select name="gender" id="sgender">
    <option value="">Select</option>
    <option>Male</option><option>Female</option><option>Other</option>
</select><span id="sgenderErr"></span><br/>

    <label>Pet you have</label>
    <select name="pet" id="pet">
        <option value="">Select</option>
        <option>Dog</option><option>Cat</option><optioon>Bird</option><option>Exotic Animal</option><option>Other</option>
    </select><span id="scountryErr"></span><br/>
    <label>Date of Birth:</label><input type="date" name="dob" id="sdob" /><span id="sdobErr"></span><br/>
    <label>Profile Picture:</label><input type="file" name="profile_picture" id="sprofile" accept="image/*" /><span id="sprofileErr"></span><br/>
    <label>Password:</label><input type="password" name="password" id="spassword" /><span id="spasswordErr"></span><br/>
    <label>Confirm Password:</label><input type="password" name="confirm_password" id="sconfirmpassword" /><span id="sconfirmpasswordErr"></span><br/>
    <input type="submit" value="Register" />
    <input type="reset" value="reset"/>

</form>
<?php include('../layout/footer.php'); ?> 
