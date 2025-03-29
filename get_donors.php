<?php
include 'db_connect.php';

$sql = "SELECT * FROM donors";
$result = $conn->query($sql);

$donors = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $donors[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($donors);

$conn->close();
?>
