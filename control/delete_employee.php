<?php
session_start();
include '../model/mydb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["employee_id"])) {
    $employee_id = intval($_POST["employee_id"]);

    // Optional: prevent deletion unless it's the logged-in user
    if (!isset($_SESSION['employee_id']) || $_SESSION['employee_id'] != $employee_id) {
        die("Unauthorized request.");
    }

    $mydb = new mydb();
    $conn = $mydb->createConObject();

    // Delete employee from DB
    $stmt = $conn->prepare("DELETE FROM employees WHERE id = ?");
    $stmt->bind_param("i", $employee_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Destroy session and redirect to login
        session_unset();
        session_destroy();
        header("Location: ../view/employeelogin.php?deleted=1");
        exit();
    } else {
        echo "Account deletion failed or employee not found.";
    }

    $stmt->close();
    $mydb->closeCon($conn);
} else {
    echo "Invalid request.";
}
?>
