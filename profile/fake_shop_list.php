<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fake Shop List</title>
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
            <h2>Fake Shop List</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>FB Link</th>
                        <th>Complain Count</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include database connection
                    include '../database/db.php';

                    // Fetch data from fakeSellers table
                    $sql = "SELECT * FROM fakeSellers";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["sellerName"] . "</td>";
                            echo "<td>" . $row["sellerEmail"] . "</td>";
                            echo "<td>" . $row["sellerAddress"] . "</td>";
                            echo "<td><a href='" . $row["sellerFBLink"] . "' target='_blank'>Click Here</a></td>";
                            echo "<td>" . $row["complainCount"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No fake shops found.</td></tr>";
                    }
                    ?>
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
                    } else if(response.subscriberStatus === 'Basic'){
                        alert("Please buy a Standard Plan to view this page");
                        window.location.href = '../Subscribe/subscribe.php';
                    }
                    
                    else {
                        document.querySelector('.main-content').style.display = 'block';
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
