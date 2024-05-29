<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trusted Shop List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/complain_history.css">
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
            <h2>Trusted Shop List</h2>
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
                    <!-- Example rows (in actual implementation, fetch data from the database) -->
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>FedEx</td>
                        <td>123456</td>
                        <td>2023-05-01</td>
                        <td><span class="badge badge-warning">Pending</span></td>
                        <td>
                            <a href="edit_complain.php?id=1" class="action-icon"><i class="fas fa-edit"></i></a>
                            <a href="delete_complain.php?id=1" class="action-icon"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if the user is logged in and redirect to index.php if not
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
                        alert('Please buy a subscription to view this page.');
                        window.location.href = '../Subscribe/subscribe.php';
                    }else if(response.subscriberStatus === 'Basic'){
                        alert("Please buy a Standard Plan to view this page");
                        window.location.href = '../Subscribe/subscribe.php';
                    }
                    
                    else {
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
