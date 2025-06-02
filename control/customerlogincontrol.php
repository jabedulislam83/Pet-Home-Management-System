<?php
session_start();
require_once "../model/customer_model.php";


function validateEmail() {
    $email = trim($_POST['email']);
    $atPosition = strpos($email, '@');
    $dotPosition = strrpos($email, '.');
    if ($email === "") {
        echo "Email is required<br>";
        //$errors['email'] = "Email is required";
        return false;
    } else if ($atPosition === false || $dotPosition === false) {
        echo "Email must contain @ and .<br>";
       //$errors['email'] = "Email must contain @ and .";
        return false;
    } else if ($atPosition < 1 || $dotPosition < $atPosition + 2 || $dotPosition + 1 >= strlen($email)) {
        echo "Invalid email format<br>";
       // $errors['email'] = "Invalid email format";
        return false;
    }
    return true;
}

// VALIDATE PASSWORD
function validatePassword() {
    $password = trim($_POST['password']);
    if ($password == "") {
       // $errors['password'] = "Password is required";
        echo "Password is required<br>";
        return false;
    } else if (strlen($password) < 6) {
        echo "Password must be at least 6 characters<br>";
       // $errors['password'] = "Password must be at least 6 characters";
        return false;
    }
    return true;
}


// LOGIN FUNCTION
function loginUserController(){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = 'customer';
    $user = [
        'email' => $email,
        'password' => $password
    ];

    
     if ($role === 'customer')
    {
        $customer = fetchCustomerByEmail($user);

        if ($customer) {
        session_unset();
        $_SESSION['name'] = $customer['name'];
        $_SESSION['email'] = $customer['email'];
        $_SESSION['phone'] = $customer['phone'];
        $_SESSION['gender'] = $customer['gender'];
        $_SESSION['pet'] = $customer['pet'];
        $_SESSION['dob'] = $customer['dob'];
        $_SESSION['profile_picture'] = $customer['profile_picture'];
        $_SESSION['role_id'] = 'customer';
        $_SESSION['logged_in'] = true;

        header("Location: ../view/customerDashboard.php");
        exit();

    } else {
        echo "Invalid customer credentials";
        //$errors['general'] = "Invalid student credentials";
    }
    } else{
        echo "Invalid role selected";
    }
     
}

// VALIDATE AND PROCESS LOGIN
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (validateEmail() && validatePassword()) {
        loginUserController();
    } else {
        echo "Invalid input<br>";
    }
}
