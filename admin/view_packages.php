<?php
include '../database/db.php'; // Include your database connection file

// Fetch all packages from the database
$query = "SELECT * FROM pricing";
$result = $conn->query($query);

$packages = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $packages[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Packages</title>
    <link rel="stylesheet" href="./css/admin_sidebar.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .main-content {
            margin-left: 280px;
            padding: 20px;
        }
        .table-container {
            max-width: 900px;
            margin: auto;
            padding: 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            background: #f9f9f9;
            border-radius: 8px;
        }
        .table-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .table-container .btn {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <?php include 'admin_sidebar.php'; ?>
    <div class="main-content">
        <div class="table-container">
            <h2>View Packages</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Package Name</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($packages) > 0): ?>
                        <?php foreach ($packages as $package): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($package['id']); ?></td>
                                <td><?php echo htmlspecialchars($package['packageName']); ?></td>
                                <td><?php echo htmlspecialchars($package['price']); ?></td>
                                <td>
                                    <a href="edit_package.php?id=<?php echo htmlspecialchars($package['id']); ?>" class="btn btn-primary btn-sm">Edit</a>
                                    <button onclick="confirmDelete(<?php echo $package['id']; ?>)" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No packages found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this package?")) {
                window.location.href = "delete_package.php?id=" + id;
            }
        }
    </script>
</body>
</html>
