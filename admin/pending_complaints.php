<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Complaint List</title>
    <link rel="stylesheet" href="../css/admin_sidebar.css">
    <link rel="stylesheet" href="../css/all_user_list.css">
    <link rel="icon" href="../images/favicon.png">
    <!-- Add your other stylesheets here -->
</head>
<body>
    <!-- Include the admin sidebar -->
    <?php include 'admin_sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <h2>Pending Complaints</h2>
            <table class="user-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Courier</th>
                        <th>User</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Populate the table rows dynamically with PHP -->
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>Basic</td>
                        <td>User</td>
                        <td><a href="view_complaint.php?id=1">View Complaint</a></td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>
    <!-- End of Main Content -->
</body>
</html>
