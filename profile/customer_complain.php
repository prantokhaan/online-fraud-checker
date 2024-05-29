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
    <style>
        .main-content {
            display: none;
        }
    </style>
</head>
<body>
    <!-- Include the sidebar using PHP -->
    <?php include '../shared/sidebar.php'; ?>
    
    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <h2>Complain Form</h2>
            <p class="terms-text">Read our <a href="../terms.php">terms and policy</a> carefully before placing any complaint.</p>
            <form id="complainForm" action="process_customer_complain.php" method="post">
                <input type="hidden" id="username" name="username">
                <div class="form-group">
                    <label for="customerName">Customer Name:</label>
                    <input type="text" id="customerName" name="customerName" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="customerEmail">Customer Email:</label>
                    <input type="email" id="customerEmail" name="customerEmail" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="customerPhone">Customer Phone:</label>
                    <input type="tel" id="customerPhone" name="customerPhone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="customerAddress">Customer Address:</label>
                    <input type="text" id="customerAddress" name="customerAddress" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="customerFacebookId">Customer Facebook ID:</label>
                    <input type="text" id="customerFacebookId" name="customerFacebookId" class="form-control">
                </div>
                <div class="form-group">
                    <label for="courierName">Courier Name:</label>
                    <input type="text" id="courierName" name="courierName" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="courierDeliveryId">Courier Delivery ID:</label>
                    <input type="text" id="courierDeliveryId" name="courierDeliveryId" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="orderedProduct">Ordered Product:</label>
                    <input type="text" id="orderedProduct" name="orderedProduct" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="proofImageLink">Image Link of Proofs:</label>
                    <input type="url" id="proofImageLink" name="proofImageLink" class="form-control" required>
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
            // checkUserAuthentication();

            // Get the username from localStorage and set it in the hidden input field
            var username = localStorage.getItem('username');
            if (username) {
                document.getElementById('username').value = username;
                checkSubscriptionStatus(username);
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

        function checkSubscriptionStatus(username) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '../Subscribe/get_subscription_status.php?username=' + encodeURIComponent(username), true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.subscriberStatus === 'None') {
                        alert('Please buy a subscription to place a complaint.');
                        window.location.href = '../Subscribe/subscribe.php';
                    } else {
                        document.querySelector('.main-content').style.display = 'block';
                    }
                } else {
                    console.error('Error checking subscription status:', xhr.statusText);
                }
            };
            xhr.send();
        }
    </script>
</body>
</html>
