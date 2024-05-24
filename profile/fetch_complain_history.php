<?php
session_start();
include '../database/db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['username'])) {
    $username = $_GET['username'];

    // Fetch complain history data from the customerComplain table
    $stmt = $conn->prepare("SELECT * FROM customerComplain WHERE userName = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = array();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
} else {
    echo json_encode(array('error' => 'Invalid request'));
}
?>
