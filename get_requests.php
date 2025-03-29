<?php
include 'db_connect.php';

$sql = "SELECT * FROM requests";
$result = $conn->query($sql);

$requests = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $requests[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($requests);

$conn->close();
?>
