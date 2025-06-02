<?php
session_start();
if (!isset($_SESSION["employee_id"])) {
    header("Location: employeelogin.php");
    exit();
}
?>

<html>
<head>
    <title>Update Employee Profile</title>
    <link rel="stylesheet" href="../css/mystyle.css">
</head>
<body>
    <h1 class="header">Update Profile</h1>
    <form action="../control/employeeupdatecontrol.php" method="post" enctype="multipart/form-data" id="updateForm">
        Phone: <input type="text" name="phone" required><br>
        Age: <input type="number" name="age" required><br>
        Address: <textarea name="address" rows="3" cols="30" required></textarea><br>
        Position: <input type="text" name="position" required><br>
        Upload New Photo: <input type="file" name="photo" accept="image/*"><br>
        <input type="submit" value="Update" class="submit">
    </form>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('updateForm');

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            if (validateForm()) {
                form.submit();
            }
        });

        function validateForm() {
            let isValid = true;
            document.querySelectorAll('.error').forEach(el => el.remove());

            function showError(input, message) {
                const error = document.createElement('div');
                error.className = 'error';
                error.style.color = 'red';
                error.style.fontSize = '14px';
                error.style.marginTop = '5px';
                error.textContent = message;
                input.parentNode.insertBefore(error, input.nextSibling);
            }

            const phone = form.querySelector('[name="phone"]');
            if (!/^[\d\s\-+]{10,15}$/.test(phone.value)) {
                showError(phone, "Please enter a valid phone number");
                isValid = false;
            }

            const age = form.querySelector('[name="age"]');
            if (age.value < 18 || age.value > 100) {
                showError(age, "Age must be between 18 and 100");
                isValid = false;
            }

            const address = form.querySelector('[name="address"]');
            if (address.value.trim().length < 10) {
                showError(address, "Address must be at least 10 characters");
                isValid = false;
            }

            const position = form.querySelector('[name="position"]');
            if (position.value.trim().length < 3) {
                showError(position, "Please enter a valid position");
                isValid = false;
            }

            const photo = form.querySelector('[name="photo"]');
            if (photo.files.length > 0) {
                const file = photo.files[0];
                const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    showError(photo, "Only JPG, PNG or GIF images are allowed");
                    isValid = false;
                }

                if (file.size > 2000000) {
                    showError(photo, "Image must be less than 2MB");
                    isValid = false;
                }
            }

            return isValid;
        }
    });
    </script>
</body>
</html>
