<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="icon" href="../images/favicon.png">
    <link rel="stylesheet" href="../css/navbar.css">
</head>
<body>
    <?php include '../landing_page/navbar.php'; ?>
    <div class="login-container">
        <div class="login-image">
            <img src="../images/login.png" alt="Login Image">
        </div>
        <div class="login-form">
            <h2>Login</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form action="process_login.php" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <div class="additional-buttons">
                    <a href="#">Forgot Password?</a>
                    <a href="register.php">Not Registered? Register</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
