<?php
session_start();
$cookies_enabled = (count($_COOKIE) > 0);
?>
<html>
<head>
    <title>Employee Registration</title>
    <link rel="stylesheet" href="../css/mystyle.css">
</head>
<body>
    <h1 class="header">Employee Sign Up</h1>
    <form action="../control/controlemployeereg.php" method="post" enctype="multipart/form-data" id="employeeForm">
        Full Name: <input type="text" name="fullname" required><br>
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        Phone: <input type="tel" name="phone" required><br>
        Age: <input type="number" name="age" min="18" required><br>
        Address: <textarea name="address" rows="3" cols="30" required></textarea><br>
        Position: <input type="text" name="position" required><br>
        Upload Photo: <input type="file" name="photo" accept="image/*" required><br>
        <input type="submit" value="Register" class="submit">
    </form>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('employeeForm');

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

            const fullname = form.querySelector('[name="fullname"]');
            if (fullname.value.trim().length < 3) {
                showError(fullname, "Full name must be at least 3 characters");
                isValid = false;
            }

            const email = form.querySelector('[name="email"]');
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
                showError(email, "Please enter a valid email");
                isValid = false;
            }

            const password = form.querySelector('[name="password"]');
            if (password.value.length < 8) {
                showError(password, "Password must be at least 8 characters");
                isValid = false;
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
            if (photo.files.length === 0) {
                showError(photo, "Please upload a photo");
                isValid = false;
            } else {
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
