<?php
include 'db_connect.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id'], $data['name'], $data['birthdate'], $data['gender'], $data['contact'], $data['blood_type'], $data['location'])) {
    $stmt = $conn->prepare("UPDATE donors SET name = ?, birthdate = ?, gender = ?, contact = ?, blood_type = ?, location = ? WHERE id = ?");
    $stmt->bind_param(
        "ssssssi",
        $data['name'],
        $data['birthdate'],
        $data['gender'],
        $data['contact'],
        $data['blood_type'],
        $data['location'],
        $data['id']
    );

    if ($stmt->execute()) {
        echo json_encode(["message" => "Donor updated successfully."]);
    } else {
        echo json_encode(["error" => "Error updating donor: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid input data."]);
}

$conn->close();
?>
