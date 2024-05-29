<?php
// Include database connection
include '../database/db.php';

// Initialize variables
$searchTerm = "";
$searchBy = "";
$sortBy = "";
$results = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Get search term, search by option, and sort by option from form
    $searchTerm = $_POST['search'];
    $searchBy = $_POST['search_by'];
    $sortBy = $_POST['sort_by'];

    // Prepare SQL query based on search criteria
    $sql = "SELECT * FROM fakeCustomers WHERE ";

    switch ($searchBy) {
        case 'name':
            $sql .= "customerName LIKE '%" . $searchTerm . "%'";
            break;
        case 'email':
            $sql .= "customerEmail LIKE '%" . $searchTerm . "%'";
            break;
        case 'phone':
            $sql .= "customerPhone LIKE '%" . $searchTerm . "%'";
            break;
        case 'facebook':
            $sql .= "customerFBLink LIKE '%" . $searchTerm . "%'";
            break;
        case 'booking':
            $sql = "SELECT * FROM customerComplain WHERE courierBookingId LIKE '%" . $searchTerm . "%'";
            break;
        default:
            // Invalid search option
            break;
    }

    // Add sorting to SQL query
    switch ($sortBy) {
        case 'name':
            $sql .= " ORDER BY customerName";
            break;
        case 'email':
            $sql .= " ORDER BY customerEmail";
            break;
        case 'phone':
            $sql .= " ORDER BY customerPhone";
            break;
        case 'complain_count':
            $sql .= " ORDER BY complainCount";
            break;
        case 'address':
            $sql .= " ORDER BY customerAddress";
            break;
        default:
            // Invalid sort option
            break;
    }

    // Execute the query
    $result = $conn->query($sql);

    // Fetch results into an associative array
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Page</title>
    <link rel="stylesheet" type="text/css" href="../css/sidebar.css">
    <link rel="stylesheet" type="text/css" href="../css/search.css">
    <link rel="icon" href="../images/favicon.png">
    <style>
        .main-content {
            display: none;
        }
    </style>
</head>
<body>
    <?php include '../shared/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <h2>Search Page</h2>
            <form method="post" action="">
                <div class="search-box">
                    <input type="text" id="search" name="search" placeholder="Enter search term" value="<?php echo $searchTerm; ?>">
                    <select name="search_by" id="search_by">
                        <option value="name" <?php if ($searchBy == 'name') echo 'selected'; ?>>Search by Name</option>
                        <option value="email" <?php if ($searchBy == 'email') echo 'selected'; ?>>Search by Email</option>
                        <option value="phone" <?php if ($searchBy == 'phone') echo 'selected'; ?>>Search by Phone Number</option>
                        <option value="facebook" <?php if ($searchBy == 'facebook') echo 'selected'; ?>>Search by Facebook ID</option>
                        <option value="booking" <?php if ($searchBy == 'booking') echo 'selected'; ?>>Search by Booking ID</option>
                    </select>
                    <select name="sort_by" id="sort_by">
                        <option value="name" <?php if ($sortBy == 'name') echo 'selected'; ?>>Sort by Name</option>
                        <option value="email" <?php if ($sortBy == 'email') echo 'selected'; ?>>Sort by Email</option>
                        <option value="phone" <?php if ($sortBy == 'phone') echo 'selected'; ?>>Sort by Phone Number</option>
                        <option value="complain_count" <?php if ($sortBy == 'complain_count') echo 'selected'; ?>>Sort by Complain Count</option>
                        <option value="address" <?php if ($sortBy == 'address') echo 'selected'; ?>>Sort by Address</option>
                    </select>
                    <button type="submit" name="submit" id="submit-btn">Search</button>
                </div>
            </form>

            <div class="results-table">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Facebook ID</th>
                            <th>Address</th>
                            <th>Complain Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Output search results
                        if (!empty($results)) {
                            foreach ($results as $row) {
                                echo "<tr>";
                                echo "<td>" . $row["customerName"] . "</td>";
                                echo "<td>" . $row["customerEmail"] . "</td>";
                                echo "<td>" . $row["customerPhone"] . "</td>";
                                echo "<td>" . $row["customerFBLink"] . "</td>";
                                echo "<td>" . $row["customerAddress"] . "</td>";
                                echo "<td>" . $row["complainCount"] . "</td>";
                                // echo "<td><a href='view_user.php'>View</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No results found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
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
                        alert("Please buy a Premium Plan to view this page");
                        window.location.href = '../Subscribe/subscribe.php';
                    }else if(response.subscriberStatus === 'Standard'){
                        alert("Please buy a Premium Plan to view this page");
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
