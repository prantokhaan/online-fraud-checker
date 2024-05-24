<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complain Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/customer_complain.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="icon" href="../images/favicon.png">
</head>
<body>
    <!-- Include the sidebar using PHP -->
    <?php include '../shared/sidebar.php'; ?>
    
    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <h2>Complain Form</h2>
            <p class="terms-text">Read our <a href="../terms.php">terms and policy</a> carefully before placing any complaint.</p>
            <form id="complainForm" action="../profile/process_complain.php" method="post">
                <input type="hidden" id="username" name="username">
                <div class="form-group">
                    <label for="sellerName">Seller Name:</label>
                    <input type="text" id="sellerName" name="sellerName" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="sellerEmail">Seller Email:</label>
                    <input type="email" id="sellerEmail" name="sellerEmail" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="sellerPhone">Seller Phone:</label>
                    <input type="tel" id="sellerPhone" name="sellerPhone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="sellerAddress">Seller Address:</label>
                    <input type="text" id="sellerAddress" name="sellerAddress" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="sellerFBLink">Seller FB Link/Website Link:</label>
                    <input type="text" id="sellerFBLink" name="sellerFBLink" class="form-control">
                </div>
                <div class="form-group">
                    <label for="courierName">Courier Name:</label>
                    <input type="text" id="courierName" name="courierName" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="courierBookingId">Courier Delivery ID:</label>
                    <input type="text" id="courierBookingId" name="courierBookingId" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="orderedProduct">Ordered Product:</label>
                    <input type="text" id="orderedProduct" name="orderedProduct" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="imageLink">Image Link of Proofs: (Upload to Google Drive and Give us the Link)</label>
                    <input type="url" id="imageLink" name="imageLink" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" id="termsCheckbox" required>
                        I will be responsible for this complaint. <a href="../terms.php">Learn more</a>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script src="../js/sidebar.js"></script>
    <script src="../js/main.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if the user is logged in and redirect to index.php if not
            checkUserAuthentication();

            // Get the username from localStorage and set it in the hidden input field
            var username = localStorage.getItem('username');
            if (username) {
                document.getElementById('username').value = username;
            } else {
                alert('User not logged in. Redirecting to home page.');
                window.location.href = '../index.php';
            }
        });

        document.getElementById('complainForm').addEventListener('submit', function(event) {
            var checkbox = document.getElementById('termsCheckbox');
            if (!checkbox.checked) {
                event.preventDefault();
                alert('You must agree to the terms and conditions.');
            }
        });
    </script>
</body>
</html>
