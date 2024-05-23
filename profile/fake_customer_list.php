<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fake Customer List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/complain_history.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="icon" href="../images/favicon.png">
</head>
<body>
    <!-- Include the sidebar using PHP -->
    <?php include '../shared/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <h2>Fake Customer List</h2>
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

    <!-- Your JavaScript files -->
    <script src="script.js"></script>
</body>
</html>
