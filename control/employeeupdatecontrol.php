<?php
session_start();
include '../model/mydb.php';

if (!isset($_SESSION["employee_id"])) {
    header("Location: ../view/employeelogin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_SESSION["employee_id"];
    $phone = $_POST["phone"];
    $age = $_POST["age"];
    $address = $_POST["address"];
    $position = $_POST["position"];

    $photo_path = null;

    // Handle photo upload if provided
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] === 0) {
        $target_dir = "../uploads/";
        $imageFileType = strtolower(pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION));
        $new_filename = uniqid() . '.' . $imageFileType;
        $target_file = $target_dir . $new_filename;

        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if ($check === false) {
            die("File is not a valid image.");
        }

        if ($_FILES["photo"]["size"] > 2000000) {
            die("File is too large. Max 2MB allowed.");
        }

        $allowed_types = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowed_types)) {
            die("Only JPG, JPEG, PNG & GIF files are allowed.");
        }

        if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            die("Error uploading the file.");
        }

        $photo_path = $new_filename;
    }

    $mydb = new mydb();
    $conn = $mydb->createConObject();

    // Escape and prepare update query
    $phone = $conn->real_escape_string($phone);
    $address = $conn->real_escape_string($address);
    $position = $conn->real_escape_string($position);
    $photo_sql = $photo_path ? ", photo_path='$photo_path'" : "";

    $query = "UPDATE employees SET phone='$phone', age=$age, address='$address', position='$position' $photo_sql WHERE id=$id";

    if ($conn->query($query) === TRUE) {
        // Update session photo if changed
        if ($photo_path) {
            $_SESSION["employee_photo"] = $photo_path;
        }
        header("Location: ../view/employeeprofile.php?updated=1");
        exit();
    } else {
        echo "Update failed: " . $conn->error;
    }

    $mydb->closeCon($conn);
} else {
    echo "Invalid request method.";
}
?>
