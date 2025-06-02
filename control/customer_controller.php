<?php
// CUSTOMER CONTROLLER
error_reporting(E_ALL);
session_start();
require_once "../model/customer_model.php"; // Adjust this to your actual model file path

// Validation functions
function validateName() {
    $name = trim($_POST['name']);
    if ($name === "") {
        echo "Name is required<br>";
        return false;
    }
    return true;
}

function validateEmail() {
    $email = trim($_POST['email']);
    $atPosition = strpos($email, '@');
    $dotPosition = strrpos($email, '.');
    if ($email === "") {
        echo "Email is required<br>";
        return false;
    } else if ($atPosition === false || $dotPosition === false) {
        echo "Email must contain @ and .<br>";
        return false;
    } else if ($atPosition < 1 || $dotPosition < $atPosition + 2 || $dotPosition + 1 >= strlen($email)) {
        echo "Invalid email format<br>";
        return false;
    }
    return true;
}

function validatePhone() {
    $phone = trim($_POST['phone']);
    if ($phone === "") {
        echo "Phone number is required<br>";
        return false;
    } else if (!preg_match('/^\d{10,15}$/', $phone)) {
        echo "Phone number must be 10 to 15 digits<br>";
        return false;
    }
    return true;
}

function validateDateOfBirth() {
    $dob = trim($_POST['dob']);
    if ($dob === "") {
        echo "Date of Birth is required<br>";
        return false;
    }
    return true;
}

function validateGender() {
    if (!isset($_POST['gender']) || trim($_POST['gender']) == "") {
        echo "Gender is required<br>";
        return false;
    }
    return true;
}

function validatePet() {
    $pet = trim($_POST['pet']);
    if ($pet === "") {
        echo "Pet selection is required<br>";
        return false;
    }
    return true;
}

function validatePassword() {
    $password = trim($_POST['password']);
    if ($password === "") {
        echo "Password is required<br>";
        return false;
    } else if (strlen($password) < 6) {
        echo "Password must be at least 6 characters<br>";
        return false;
    }
    return true;
}

function validateConfirmPassword() {
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);
    if (empty($confirmPassword)) {
        echo "Confirm password is required<br>";
        return false;
    } else if ($password !== $confirmPassword) {
        echo "Password and confirm password do not match<br>";
        return false;
    }
    return true;
}

function validateUploadPhoto() {
    if (!isset($_FILES["profile_picture"]) || $_FILES["profile_picture"]["error"] === UPLOAD_ERR_NO_FILE) {
        echo "Profile Picture is required.<br>";
        return false;
    }
    $file = $_FILES["profile_picture"];
    $allowedTypes = ["image/jpg", "image/jpeg", "image/png"];
    $maxSize = 5 * 1024 * 1024; // 5MB

    if ($file["error"] !== UPLOAD_ERR_OK) {
        echo "Error uploading profile picture.<br>";
        return false;
    }

    if (!in_array($file["type"], $allowedTypes)) {
        echo "Only JPG, JPEG, or PNG formats are allowed for Profile Picture.<br>";
        return false;
    }

    if ($file["size"] > $maxSize) {
        echo "Profile picture size must be less than 5MB.<br>";
        return false;
    }
    
    // Move the file will be handled separately in pushCustomer()
    return true;
}

function validateCustomerForm() {
    return (
        validateName() &&
        validateEmail() &&
        validatePhone() &&
        validateDateOfBirth() &&
        validateGender() &&
        validatePet() &&
        validatePassword() &&
        validateConfirmPassword() &&
        validateUploadPhoto()
    );
}

function pushCustomer(){
    $conn = getConnection();

    $file = $_FILES["profile_picture"];
    $tmp = explode('.', $file['name']);
    $newFileName = round(microtime(true)) . '.' . end($tmp);
    $uploadDir = "../assets/uploads/customers/";
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
    $uploadPath = $uploadDir . $newFileName;

    if (!move_uploaded_file($file["tmp_name"], $uploadPath)) {
        echo "Failed to upload profile picture.<br>";
        return false;
    }

    $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $phone = mysqli_real_escape_string($conn, trim($_POST['phone']));
    $dob = mysqli_real_escape_string($conn, trim($_POST['dob']));
    $gender = mysqli_real_escape_string($conn, trim($_POST['gender']));
    $pet = mysqli_real_escape_string($conn, trim($_POST['pet']));
    $password_raw = $_POST['password']; // raw password to hash
    $password = password_hash($password_raw, PASSWORD_DEFAULT);
    $profile_picture = mysqli_real_escape_string($conn, $uploadPath);
    $created_at = date("Y-m-d H:i:s");

    $customer = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'dob' => $dob,
        'gender' => $gender,
        'pet' => $pet,
        'password' => $password,
        'profile_picture' => $profile_picture,
        'created_at' => $created_at
    ];

    $status = insertCustomer($customer);
    return $status;
}

function updateCustomerfunc() {
    $conn = getConnection();

    $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    $phone = mysqli_real_escape_string($conn, trim($_POST['phone']));
    $gender = mysqli_real_escape_string($conn, trim($_POST['gender']));
    $pet = mysqli_real_escape_string($conn, trim($_POST['pet']));
    $dob = mysqli_real_escape_string($conn, trim($_POST['dob']));
    $email = mysqli_real_escape_string($conn, trim($_SESSION['email'] ?? ''));

    $oldProfilePicture = $_POST['old_profile_picture'] ?? '';

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] !== UPLOAD_ERR_NO_FILE) {
        $profileFile = $_FILES['profile_picture'];
        $tmpProfile = explode('.', $profileFile['name']);
        $profileFileName = round(microtime(true)*1000) . '.' . end($tmpProfile);
        $uploadDir = "../assets/uploads/customers/";
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $uploadPath = $uploadDir . $profileFileName;
        move_uploaded_file($profileFile['tmp_name'], $uploadPath);
        $profile_picture = mysqli_real_escape_string($conn, $uploadPath);
    } else {
        $profile_picture = mysqli_real_escape_string($conn, $oldProfilePicture);
    }

    $customer = [
        'name' => $name,
        'phone' => $phone,
        'gender' => $gender,
        'pet' => $pet,
        'dob' => $dob,
        'profile_picture' => $profile_picture,
        'email' => $email
    ];

    $result = updateCustomer($customer);

    if ($result) {
        return $customer;  // Return updated data for session update
    } else {
        return false;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_GET['action'] ?? '';

    if ($action === "register") {
        if (validateCustomerForm() && pushCustomer()) {
            header('Location: ../view/customerlogin.php'); // Change to your login page
            exit();
        } else {
            echo "The email has already been used or there was an error.";
        }
    } elseif ($action === "update") {
        $updatedCustomer = updateCustomerfunc();
        if ($updatedCustomer) {
            $_SESSION['name'] = $updatedCustomer['name'];
            $_SESSION['phone'] = $updatedCustomer['phone'];
            $_SESSION['gender'] = $updatedCustomer['gender'];
            $_SESSION['pet'] = $updatedCustomer['pet'];
            $_SESSION['dob'] = $updatedCustomer['dob'];
            $_SESSION['profile_picture'] = $updatedCustomer['profile_picture'];

            header('Location: ../view/customerupdate.php'); // Change as needed
            exit();
        } else {
            echo "Failed to update customer information<br>";
        }
    } elseif ($action === "delete") {
        $emailToDelete = trim($_POST['email'] ?? '');
        if ($emailToDelete !== '') {
            $customer = ['email' => $emailToDelete];
            deleteCustomerFromDB($customer);
            session_destroy();
            header('Location: ../view/login.php'); // Change as needed
            exit();
        } else {
            echo "Email is required to delete the customer.";
        }
    } else {
        echo "Invalid action.";
    }
} else {
    echo "Invalid request method.";
}
