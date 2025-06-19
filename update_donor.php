<?php
include 'db_connect.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id'], $data['name'], $data['birthdate'], $data['gender'], $data['contact'], $data['blood_type'], $data['location'])) {
    $id = intval($data['id']);
    $name = $data['name'];
    $birthdate = $data['birthdate'];
    $gender = $data['gender'];
    $contact = $data['contact'];
    $bloodType = $data['blood_type'];
    $location = $data['location'];

    $stmt = $conn->prepare("UPDATE donors SET name = ?, birthdate = ?, gender = ?, contact = ?, blood_type = ?, location = ? WHERE id = ?");
    $stmt->bind_param("ssssssi", $name, $birthdate, $gender, $contact, $bloodType, $location, $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(["message" => "Donor updated successfully."]);
        } else {
            echo json_encode(["error" => "No rows affected. Donor ID may not exist."]);
        }
    } else {
        echo json_encode(["error" => "Failed to execute update query."]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid input data."]);
}

$conn->close();
?>
