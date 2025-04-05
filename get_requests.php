<?php
include 'db_connect.php';

$sql = "SELECT * FROM requests";
$result = $conn->query($sql);

$requests = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $requests[] = $row;
    }
    echo json_encode($requests);
} else {
    echo json_encode(['error' => 'Failed to fetch requests.']);
}

$conn->close();
?>
