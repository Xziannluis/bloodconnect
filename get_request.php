<?php
header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'Request ID is required']);
    exit;
}

$requestId = intval($_GET['id']);

include 'db_connect.php';

$stmt = $conn->prepare("SELECT * FROM requests WHERE id = ?");
$stmt->bind_param("i", $requestId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $request = $result->fetch_assoc();
    echo json_encode($request);
} else {
    echo json_encode(['error' => 'Request not found']);
}

$stmt->close();
$conn->close();
?>
