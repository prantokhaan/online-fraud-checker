<?php
include '../database/db.php';

$query = "SELECT id, customerName, courierName, customerFBLink, complainStatus, created_at FROM customerComplain WHERE LOWER(complainStatus) = 'accepted'";
$result = $conn->query($query);

$complaints = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $complaints[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accepted Complaints</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/complain_history.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="icon" href="../images/favicon.png">
    <style>
        .main-content {
            display: block;
        }
    </style>
</head>
<body>
    <!-- Include the sidebar using PHP -->
    <?php include '../shared/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <h2>Accepted Complaints</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Complain ID</th>
                        <th>Customer Name</th>
                        <th>Courier Name</th>
                        <th>Customer FB Link</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($complaints) > 0): ?>
                        <?php foreach ($complaints as $complaint): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($complaint['id']); ?></td>
                                <td><?php echo htmlspecialchars($complaint['customerName']); ?></td>
                                <td><?php echo htmlspecialchars($complaint['courierName']); ?></td>
                                <td><a href="<?php echo htmlspecialchars($complaint['customerFBLink']); ?>" target="_blank">View FB Profile</a></td>
                                <td>
                                    <?php
                                    $date = new DateTime($complaint['created_at']);
                                    echo $date->format('d F, Y');
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No accepted complaints found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
