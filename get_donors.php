<?php
include 'db_connect.php';

$sql = "SELECT * FROM donors";
$result = $conn->query($sql);

$donors = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $donors[] = $row;
    }
    echo json_encode($donors);
} else {
    echo json_encode(['error' => 'Failed to fetch donors.']);
}

$conn->close();
?>
