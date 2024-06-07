<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="icon" href="../images/favicon.png">
    <link rel="stylesheet" href="./courierNavbar.css">
</head>
<body>
    <?php include './courierNavbar.php'; ?>
    <div class="login-container">
        <div class="login-image">
            <img src="./courier.png" alt="Login Image">
        </div>
        <div class="login-form">
            <h2>Login</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form action="process_courier_login.php" method="post">
                <div class="form-group">
                    <label for="username">Courier Name</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Enter your Courier Name" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
