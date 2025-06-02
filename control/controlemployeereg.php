<?php
session_start();
include '../model/mydb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // File upload handling
    $target_dir = "../uploads/";
 
    $imageFileType = strtolower(pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION));
    $new_filename = uniqid() . '.' . $imageFileType;
    $target_file = $target_dir . $new_filename;

    // Validate image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check === false) {
        die("File is not a valid image.");
    }

    if ($_FILES["photo"]["size"] > 2000000) {
        die("Sorry, your file is too large.");
    }

    $allowed_types = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowed_types)) {
        die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
    }

    if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        die("Error uploading file.");
    }

    // Form data
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $phone = $_POST["phone"];
    $age = $_POST["age"];
    $address = $_POST["address"];
    $position = $_POST["position"];
    $photo_path = $new_filename; // just filename, no directory path in DB

    $mydb = new mydb();
    $conobj = $mydb->createConObject();
    $result = $mydb->createEmployee(
        $conobj,
        "employees",
        $fullname,
        $email,
        $password,
        $phone,
        $age,
        $address,
        $position,
        $photo_path
    );

    if ($result === false) {
        unlink($target_file); // cleanup if failed
        die("Registration failed: " . $conobj->error);
    } else {
        header("Location: ../view/employeelogin.php?registered=1");
        exit();
    }

    $mydb->closeCon($conobj);
}
?>
