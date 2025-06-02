<?php 
require_once '../model/mydb.php';

function fetchCustomerByEmail($customer) {
    $conn = getConnection();
    $email = $conn->real_escape_string($customer['email']);
    $sql = "SELECT * FROM customers WHERE email = '{$email}'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

function insertCustomer($customer) {
    $conn = getConnection();

    // Escape strings to avoid SQL injection
    $name = $conn->real_escape_string($customer['name']);
    $email = $conn->real_escape_string($customer['email']);
    $phone = $conn->real_escape_string($customer['phone']);
    $gender = $conn->real_escape_string($customer['gender']);
    $pet = $conn->real_escape_string($customer['pet']);
    $dob = $conn->real_escape_string($customer['dob']);
    $profile_picture = $conn->real_escape_string($customer['profile_picture']);
    $password = $conn->real_escape_string($customer['password']); // Assume already hashed
    $created_at = $conn->real_escape_string($customer['created_at']);

    $checkEmail = "SELECT * FROM customers WHERE email = '{$email}'";
    $result = mysqli_query($conn, $checkEmail);

    if (mysqli_num_rows($result) == 0) {
        $sql = "INSERT INTO customers (
            name, email, phone, gender,
            pet, dob, profile_picture, password, created_at
        ) VALUES (
            '{$name}', '{$email}', '{$phone}', '{$gender}',
            '{$pet}', '{$dob}', '{$profile_picture}', '{$password}', '{$created_at}'
        )";

        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            echo "Insert error: " . mysqli_error($conn); // Debugging
            return false;
        }
    } else {
        return false; // Email already exists
    }
}

function updateCustomer($customer) {
    $conn = getConnection();

    $name = $conn->real_escape_string($customer['name']);
    $phone = $conn->real_escape_string($customer['phone']);
    $gender = $conn->real_escape_string($customer['gender']);
    $pet = $conn->real_escape_string($customer['pet']);
    $dob = $conn->real_escape_string($customer['dob']);
    $profile_picture = $conn->real_escape_string($customer['profile_picture']);
    $email = $conn->real_escape_string($customer['email']);

    $sql = "UPDATE customers SET
        name = '{$name}',
        phone = '{$phone}',
        gender = '{$gender}',
        pet = '{$pet}',
        dob = '{$dob}',
        profile_picture = '{$profile_picture}'
     WHERE email = '{$email}'";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Update error: " . mysqli_error($conn);
        return false;
    }
}

function deleteCustomerFromDB($customer) {
    $conn = getConnection();
    $email = $conn->real_escape_string($customer['email']);
    $sql = "DELETE FROM customers WHERE email = '{$email}'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Deleted Successfully";
    } else {
        echo "Delete error: " . mysqli_error($conn);
    }
}
?>
