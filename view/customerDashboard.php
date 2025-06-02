<?php
session_start();
if (isset($_SESSION['email'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Profile</title>
        <link rel="stylesheet" href="../assets/css/style.css?v2.0">
    </head>

    <body>
        <?php include_once "../layout/header.php"; ?>

        <h3>My Profile</h3>

        <p><strong>Name:</strong> <?= htmlspecialchars($_SESSION['name'] ?? '') ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($_SESSION['phone'] ?? '') ?></p>
        <p><strong>Gender:</strong> <?= htmlspecialchars($_SESSION['gender'] ?? '') ?></p>
        <p><strong>My Pet:</strong> <?= htmlspecialchars($_SESSION['pet'] ?? '') ?></p>
        <p><strong>Date of Birth:</strong> <?= htmlspecialchars($_SESSION['dob'] ?? '') ?></p>
        <p><strong>Profile Picture:</strong><br />
            <?php if (!empty($_SESSION['profile_picture'])): ?>
                <img src="<?= htmlspecialchars($_SESSION['profile_picture']) ?>" alt="Profile Picture" style="width:150px;height:auto;">
            <?php else: ?>
                <em>No picture uploaded</em>
            <?php endif; ?>
        </p>

        <form method="POST" action="../control/customer_controller.php?action=delete" onsubmit="return confirm('Are you sure you want to delete your account?');">
            <input type="hidden" name="email" value="<?= htmlspecialchars($_SESSION['email']) ?>" />
            <button type="submit" class="button red">Delete My Account</button>
        </form>

        <br />
        <a href="customerupdate.php" class="button green">Update Information</a>

        <?php include '../layout/footer.php'; ?>
    </body>

    </html>
<?php
} else {
    header("Location:../view/login.php");
    exit();
}
?>
