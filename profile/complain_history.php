<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complain History</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../css/complain_history.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="icon" href="favicon.ico">
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
            <h2>Complain History</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Complain ID</th>
                        <th>Name</th>
                        <th>Courier</th>
                        <th>Courier ID</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Complain history data will be displayed here -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal  -->
    <div class="modal" id="confirmDeleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this complaint?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include the JavaScript file -->
    <script src="fetchComplainHistory.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if the user is logged in and redirect to index.php if not
            // checkUserAuthentication();

            // Get the username from localStorage and set it in the hidden input field
            var username = localStorage.getItem('username');
            if (username) {
                checkSubscriptionStatus(username);
            } else {
                alert('User not logged in. Redirecting to home page.');
                window.location.href = '../index.php';
            }
        });

        function checkSubscriptionStatus(username) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '../Subscribe/get_subscription_status.php?username=' + encodeURIComponent(username), true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.subscriberStatus === 'None') {
                        alert('Please buy a subscription to view your complain history.');
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
