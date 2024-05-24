<nav>
    <div class="navbar-container">
        <div class="logo">
            <a href="../index.php" class="logo-link">O <span>F</span> C</a>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="../contact.php">Contact</a></li>
        </ul>
        <div class="auth-buttons" id="auth-buttons">
            <?php
            // PHP to dynamically generate authentication buttons based on user login status
            if(isset($_SESSION['username'])) {
                echo '<a href="../profile/profile.php" class="me-5"><i class="fas fa-user"> <span>' . $_SESSION['username'] . '</span></i></a>'; // Font Awesome icon for user profile
                echo '<a onclick="logout()" href="#"><i class="fas fa-sign-out-alt"><span>LogOut</span></i></a>'; // Font Awesome icon for logout
            } else {
                echo '<a href="../auth/login.php">Login</a>';
                echo '<a href="../auth/register.php">Register</a>';
            }
            ?>
        </div>
    </div>
</nav>
