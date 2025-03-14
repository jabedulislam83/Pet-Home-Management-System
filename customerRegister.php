<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration Page</title>
    
        
</head>
<body>

    <h2>Customer Registration</h2>

    <form action="action_page.php" method="post">
        <table>
            
            
            <tr>
                <td><label for="username">Username:</label></td>
                <td colspan="3"><input type="text" id="username" name="username" required></td>
            </tr>

        
            <tr>
                <td><label for="email">Email:</label></td>
                <td colspan="3"><input type="email" id="email" name="email" required></td>
            </tr>

            <tr>
                <td><label for="district">Choose your District:</label></td>
                <td colspan="3">
                    <select id="district" name="District">
                        <option value="dhaka">Dhaka</option>
                        <option value="khulna">Khulna</option>
                        <option value="sylhet">Sylhet</option>
                        <option value="bogra">Bogra</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td><label for="address">Address:</label></td>
                <td><textarea id="address" name="address" rows="3" required></textarea></td>
            </tr>
            <tr>
                <td><label for="pet-type">Your Pet Type:</label></td>
                <td><input type="radio" id="dog" name="pet" value="Dog">
                <label for="dog">Dog</label>
                <input type="radio" id="cat" name="pet" value="Cat">
                <label for="cat">Cat</label>
                <input type="radio" id="bird" name="pet" value="Bird">
                <label for="bird">Bird</label>
                <input type="radio" id="rabbit" name="pet" value="Rabbit">
                <label for="rabbit">Rabbit</label>
                </td>
            </tr>

            <tr>
                <td><label for="breed">Breed :</label></td>
                <td><input type="text" id="breed" name="breed"></td>
            </tr>
            <tr>
                <td><label for="age">Age :</label></td>
                <td><input type="range" id="vol" name="vol" min="0" max="20"></td>
            </tr>

        
            <tr>
                <td><label for="password">Password:</label></td>
                <td colspan="3"><input type="password" id="password" name="password" required></td>
            </tr>
            <tr>
            <td colspan="4"><input type="checkbox" id="terms" name="terms" required>
            <label for="terms">I agree to the <a href="terms.html" target="_blank">Terms and Conditions</a></label></td>
            </tr>

            <tr>
                <td colspan="4">
                    <input type="submit" value="Register">
                    <input type="reset" value="Reset">
                </td>
            </tr>

            <tr>
                <td colspan="4">
                    Already have an account? <a href="login.php">Login here</a>
                </td>
            </tr>
        </table>
    </form>

</body>
</html>
