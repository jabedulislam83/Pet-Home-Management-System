<?php
session_start();
include '../model/mydb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $mydb = new mydb();
    $conn = $mydb->createConObject();

    // Use prepared statement for security
    $stmt = $conn->prepare("SELECT id, fullname, email, password, photo_path FROM employees WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify the hashed password
        if (password_verify($password, $user["password"])) {
            // Set session variables
            $_SESSION["employee_id"] = $user["id"];
            $_SESSION["employee_name"] = $user["fullname"];
            $_SESSION["employee_email"] = $user["email"];
            $_SESSION["employee_photo"] = $user["photo_path"];

            // Redirect to employee profile page
            header("Location: ../view/employeeprofile.php");
            exit();
        } else {
            echo " Invalid password.";
        }
    } else {
        echo " No user found with that email.";
    }

    $stmt->close();
    $mydb->closeCon($conn);
}
?>
