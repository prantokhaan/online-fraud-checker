<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Subscriber List</title>
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
            <div class="title pb-4">
                <h2>All Subscriber</h2>
                <div class="filter-option">
                    <select name="filter" id="filter">
                        <option value="all">All Complaints</option>
                        <option value="open">Open Complaints</option>
                        <option value="closed">Closed Complaints</option>
                    </select>
                    <button class="btn">Apply Filter</button>
                </div>
            </div>
            <table class="user-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Plan</th>
                        <th>Role</th>
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
                        <td><a href="view_user.php?id=1">View User</a></td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>
    <!-- End of Main Content -->
</body>
</html>
