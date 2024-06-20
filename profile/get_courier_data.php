<?php
include '../database/db.php'; 

$query = "SELECT id, courierName FROM courierAccount";
$result = $conn->query($query);

$couriers = [];

while ($row = $result->fetch_assoc()) {
    $courierId = $row['id'];
    $courierName = $row['courierName'];

    // Count complaints from sellerComplain table
    $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM sellerComplain WHERE courierName = ?");
    $stmt->bind_param("s", $courierName);
    $stmt->execute();
    $stmt->bind_result($sellerCount);
    $stmt->fetch();
    $stmt->close();

    // Count complaints from customerComplain table
    $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM customerComplain WHERE courierName = ?");
    $stmt->bind_param("s", $courierName);
    $stmt->execute();
    $stmt->bind_result($customerCount);
    $stmt->fetch();
    $stmt->close();

    $totalCount = $sellerCount + $customerCount;

    $couriers[] = [
        'id' => $courierId,
        'courierName' => $courierName,
        'complainCount' => $totalCount
    ];
}

$conn->close();

// Sort couriers by complainCount in descending order
usort($couriers, function($a, $b) {
    return $b['complainCount'] - $a['complainCount'];
});

header('Content-Type: application/json');
echo json_encode($couriers);
?>
