<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    echo json_encode(['error' => 'Invalid request method']);
    exit;
}

parse_str(file_get_contents("php://input"), $data);

if (!isset($data['id'])) {
    echo json_encode(['error' => 'Request ID is required']);
    exit;
}

$requestId = intval($data['id']);

include 'db_connect.php';

$stmt = $conn->prepare("DELETE FROM requests WHERE id = ?");
$stmt->bind_param("i", $requestId);

if ($stmt->execute() && $stmt->affected_rows > 0) {
    echo json_encode(['message' => 'Request deleted successfully.']);
} else {
    echo json_encode(['error' => 'Failed to delete request.']);
}

$stmt->close();
$conn->close();
?>
