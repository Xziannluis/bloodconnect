<?php
header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'Donor ID is required']);
    exit;
}

$donorId = intval($_GET['id']);

include 'db_connect.php';

$stmt = $conn->prepare("SELECT * FROM donors WHERE id = ?");
$stmt->bind_param("i", $donorId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $donor = $result->fetch_assoc();
    echo json_encode($donor);
} else {
    echo json_encode(['error' => 'Donor not found']);
}

$stmt->close();
$conn->close();
?>
