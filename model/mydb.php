<?php
class mydb {
    private $DBHostName = "localhost";
    private $DBUserName = "root";
    private $DBPassword = "";
    private $DBName = "pet_daycare";

    // Create database connection
    public function createConObject() {
        $conn = new mysqli($this->DBHostName, $this->DBUserName, $this->DBPassword, $this->DBName);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    // Create employee using prepared statement (safer)
    public function createEmployee($conn, $table, $fullname, $email, $password, $phone, $age, $address, $position, $photo_path) {
        $stmt = $conn->prepare("INSERT INTO $table 
            (fullname, email, password, phone, age, address, position, photo_path, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("ssssisss", $fullname, $email, $password, $phone, $age, $address, $position, $photo_path);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    // Close connection
    public function closeCon($conn) {
        $conn->close();
    }

    // Optional: You can add more reusable functions here like getEmployeeByEmail, updateEmployee, etc.
}
?>
