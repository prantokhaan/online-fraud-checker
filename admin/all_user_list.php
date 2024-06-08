<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All User List</title>
    <link rel="stylesheet" href="./css/admin_sidebar.css">
    <link rel="stylesheet" href="./css/all_user_list.css">
    <link rel="icon" href="../images/favicon.png">
</head>
<body>
    <!-- Include the admin sidebar -->
    <?php include 'admin_sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <div class="title pb-4">
                <h2>All User List</h2>
                <div class="filter-search">
                    <div class="filter-option">
                        <select name="filter" id="filter">
                            <option value="all">All</option>
                            <option value="sellers">Show Sellers</option>
                            <option value="customers">Show Customers</option>
                            <option value="subscribers">Subscribers</option>
                            <option value="banned">Banned Users</option>
                            <option value="requested">Requested to Unban</option>
                        </select>
                    </div>
                    <div class="search-box">
                        <input type="text" id="search" placeholder="Search by Full Name">
                        <button id="searchBtn" class="btn-search">Search</button>
                    </div>
                </div>
            </div>
            <table class="user-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Plan</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include the database connection file
                    include '../database/db.php';

                    // Default query to fetch all users
                    $query = "SELECT id, fullName, subscriberStatus, accountStatus, registerAs FROM users";

                    // Check if filter option is selected
                    if (isset($_GET['filter'])) {
                        $filter = $_GET['filter'];

                        // Modify query based on filter option
                        switch ($filter) {
                            case 'sellers':
                                $query .= " WHERE registerAs = 'seller'";
                                break;
                            case 'customers':
                                $query .= " WHERE registerAs = 'customer'";
                                break;
                            case 'subscribers':
                                $query .= " WHERE subscriberStatus != 'none'";
                                break;
                            case 'banned':
                                $query .= " WHERE accountStatus = 'banned'";
                                break;
                            case 'requested':
                                $query .= " WHERE accountStatus = 'requested'";
                                break;
                            default:
                                // For 'all' option, no additional condition is needed
                                break;
                        }
                    }

                    // Check if search parameter is provided
                    if (isset($_GET['search'])) {
                        $search = $_GET['search'];

                        // Add search condition to the query
                        $query .= " WHERE fullName LIKE '%$search%'";
                    }

                    // Execute the query
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['fullName'] . "</td>";
                            echo "<td>" . $row['subscriberStatus'] . "</td>";
                            echo "<td>" . $row['registerAs'] . "</td>";
                            echo "<td>" . $row['accountStatus'] . "</td>";
                            echo "<td><a href='view_user.php?id=" . $row['id'] . "'>View User</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No users found.</td></tr>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- End of Main Content -->

    <script>
        document.getElementById("searchBtn").addEventListener("click", function() {
            var searchValue = document.getElementById("search").value.trim();
            var filterValue = document.getElementById("filter").value;
            var url = "all_user_list.php";

            // Append filter parameter
            url += "?filter=" + filterValue;

            // Append search parameter if not empty
            if (searchValue !== "") {
                url += "&search=" + encodeURIComponent(searchValue);
            }

            // Redirect to the updated URL
            window.location.href = url;
        });
    </script>
</body>
</html>
