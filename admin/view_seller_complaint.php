<?php
include '../database/db.php'; // Include your database connection file

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM sellerComplain WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $complaint = $result->fetch_assoc();
    $stmt->close();
} else {
    echo "<script>
        alert('Invalid request.');
        window.location.href = 'all_seller_complaints.php';
    </script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Complaint</title>
    <link rel="stylesheet" href="./css/view_user.css">
    <link rel="stylesheet" href="./css/admin_sidebar.css">
    <link rel="icon" href="../images/favicon.png">
    
    <script>
        function changeStatus(id, status) {
            if (confirm('Are you sure you want to ' + status + ' this complaint?')) {
                window.location.href = 'change_seller_complaint_status.php?id=' + id + '&status=' + status;
            }
        }

        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this complaint?')) {
                window.location.href = 'delete_seller_complaint.php?id=' + id;
            }
        }
    </script>
</head>
<body>
    <!-- Include the admin sidebar using PHP -->
    <?php include 'admin_sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <h2>View Complaint</h2>
            <div class="user-info <?php echo $complaint['complainStatus'] == 'accepted' ? 'accepted' : ($complaint['complainStatus'] == 'rejected' ? 'rejected' : ''); ?>">
                <div class="info-item">
                    <label>Complaint ID:</label>
                    <span><?php echo htmlspecialchars($complaint['id']); ?></span>
                </div>
                <div class="info-item">
                    <label>User Name:</label>
                    <span><?php echo htmlspecialchars($complaint['userName']); ?></span>
                </div>
                <div class="info-item">
                    <label>Seller Name:</label>
                    <span><?php echo htmlspecialchars($complaint['sellerName']); ?></span>
                </div>
                <div class="info-item">
                    <label>Seller Email:</label>
                    <span><?php echo htmlspecialchars($complaint['sellerEmail']); ?></span>
                </div>
                <div class="info-item">
                    <label>Seller Phone:</label>
                    <span><?php echo htmlspecialchars($complaint['sellerPhone']); ?></span>
                </div>
                <div class="info-item">
                    <label>Seller Address:</label>
                    <span><?php echo htmlspecialchars($complaint['sellerAddress']); ?></span>
                </div>
                <div class="info-item">
                    <label>Seller FB Link:</label>
                    <span><?php echo htmlspecialchars($complaint['sellerFBLink']); ?></span>
                </div>
                <div class="info-item">
                    <label>Courier Name:</label>
                    <span><?php echo htmlspecialchars($complaint['courierName']); ?></span>
                </div>
                <div class="info-item">
                    <label>Courier Booking ID:</label>
                    <span><?php echo htmlspecialchars($complaint['courierBookingId']); ?></span>
                </div>
                <div class="info-item">
                    <label>Ordered Product:</label>
                    <span><?php echo htmlspecialchars($complaint['orderedProduct']); ?></span>
                </div>
                <div class="info-item">
                    <label>Image Link:</label>
                    <span><a href="<?php echo htmlspecialchars($complaint['imageLink']); ?>" target="_blank">View Image</a></span>
                </div>
                <div class="info-item">
                    <label>Complaint Status:</label>
                    <span><?php echo htmlspecialchars($complaint['complainStatus']); ?></span>
                </div>
                <div class="info-item">
                    <label>Created At:</label>
                    <span><?php echo htmlspecialchars($complaint['created_at']); ?></span>
                </div>
                <div class="action-buttons">
                    <?php if (strtolower($complaint['complainStatus']) == 'accepted') { ?>
                        <button class="btn-reject" onclick="changeStatus(<?php echo $complaint['id']; ?>, 'rejected')">Reject</button>
                    <?php } elseif (strtolower($complaint['complainStatus']) == 'rejected') { ?>
                        <button class="btn-approve" onclick="changeStatus(<?php echo $complaint['id']; ?>, 'accepted')">Approve</button>
                    <?php } ?>
                    <button class="btn-delete" onclick="confirmDelete(<?php echo $complaint['id']; ?>)">Delete</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
