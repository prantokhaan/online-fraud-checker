<?php
include '../database/db.php';

$couriers = array();
$error_message = '';

// Check if the request is an AJAX request and if the courier name is set
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['courier_name']) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    $courier_name = $_POST['courier_name'];

    $stmt = $conn->prepare("SELECT * FROM courier WHERE courierName = ?");
    $stmt->bind_param("s", $courier_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $couriers[] = $row;
        }
    } else {
        $error_message = "No courier data found for the logged-in courier.";
    }

    $stmt->close();

    // Return the courier data as JSON
    echo json_encode(array('couriers' => $couriers, 'error_message' => $error_message));
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courier Details</title>
    <link rel="stylesheet" href="show_bookings.css">
    <link rel="stylesheet" href="courierNavbar.css">
</head>
<body>
    <?php include './courierNavbar.php'; ?>
    <div class="container">
        <h1>Courier Details</h1>
        <div class="couriers">
            <table>
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Customer Phone</th>
                        <th>Seller Name</th>
                        <th>Seller Phone</th>
                        <th>Booking ID</th>
                        <th>Ordered Product</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody id="courier-details-body">
                    <!-- Courier data will be populated here using JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var courierName = localStorage.getItem('courier');
            if (!courierName) {
                alert('Courier not logged in.');
                window.location.href = './courierLogin.php';
                return;
            }

            // Send AJAX request to fetch courier data
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    var couriers = response.couriers;
                    var error_message = response.error_message;

                    if (error_message) {
                        alert(error_message);
                        return;
                    }

                    // Populate courier data in the table
                    var tbody = document.getElementById('courier-details-body');
                    for (var i = 0; i < couriers.length; i++) {
                        var courier = couriers[i];
                        var row = '<tr>' +
                            '<td>' + courier.customerName + '</td>' +
                            '<td>' + courier.customerPhone + '</td>' +
                            '<td>' + courier.sellerName + '</td>' +
                            '<td>' + courier.sellerPhone + '</td>' +
                            '<td>' + courier.courierBookingId + '</td>' +
                            '<td>' + courier.orderedProduct + '</td>' +
                            '<td>' + courier.created_at + '</td>';
                        tbody.innerHTML += row;
                    }
                } else {
                    alert('Request failed. Please try again later.');
                }
            };
            xhr.onerror = function() {
                alert('Request failed. Please try again later.');
            };
            xhr.send('courier_name=' + encodeURIComponent(courierName));
        });
    </script>

    <script src="./main.js"></script>
</body>
</html>
