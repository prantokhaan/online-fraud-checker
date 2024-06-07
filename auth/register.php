<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="icon" href="../images/favicon.png">
</head>
<script>
        function validateForm() {
            // Check if terms and conditions checkbox is checked
            if (!document.getElementById('terms').checked) {
                alert("Please agree to terms and conditions.");
                return false;
            }

            // Check if passwords match
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirmPassword').value;
            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }

            return true;
        }
    </script>
<body>
    <?php include '../landing_page/navbar.php'; ?>
    <div class="register-container">
        <div class="register-form">
            <h2>Register</h2>
            <?php
            if (isset($_GET['error']) && $_GET['error'] == 'username_exists') {
                echo '<div class="alert alert-danger">Username already exists. Please choose another one.</div>';
            }
            ?>
            <form action="process_register.php" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="registerAs">Register as:</label>
                        <select id="registerAs" name="registerAs" class="form-control" required>
                            <option value="customer">Customer</option>
                            <option value="seller">Seller</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fullName">Full Name:</label>
                        <input type="text" id="fullName" name="fullName" class="form-control" placeholder="Enter your full name" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="shopName">Shop Name (if seller):</label>
                        <input type="text" id="shopName" name="shopName" class="form-control" placeholder="Enter your shop name (optional)">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="age">Age:</label>
                        <input type="number" id="age" name="age" class="form-control" placeholder="Enter your age" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email address" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="phoneNumber">Phone Number:</label>
                        <input type="tel" id="phoneNumber" name="phoneNumber" class="form-control" placeholder="Enter your phone number" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" class="form-control" placeholder="Enter your address" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="confirmPassword">Confirm Password:</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm your password" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" required>
                        I agree to terms and conditions
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <div class="additional-buttons">
                <a href="login.php">Already registered? Log in</a>
            </div>
        </div>
    </div>

    <script src="../js/navbar.js"></script>
</body>
</html>
