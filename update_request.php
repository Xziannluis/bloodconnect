<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db_connect.php';

    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['id'], $data['name'], $data['birthdate'], $data['gender'], $data['contact'], $data['bloodType'], $data['location'])) {
        $id = intval($data['id']);
        $name = $data['name'];
        $birthdate = $data['birthdate'];
        $gender = $data['gender'];
        $contact = $data['contact'];
        $bloodType = $data['bloodType'];
        $location = $data['location'];

        $stmt = $conn->prepare("UPDATE requests SET name = ?, birthdate = ?, gender = ?, contact = ?, blood_type = ?, location = ? WHERE id = ?");
        $stmt->bind_param("ssssssi", $name, $birthdate, $gender, $contact, $bloodType, $location, $id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(["message" => "Request updated successfully."]);
            } else {
                echo json_encode(["error" => "No rows affected. Request ID may not exist."]);
            }
        } else {
            echo json_encode(["error" => "Failed to execute update query."]);
        }

        $stmt->close();
    } else {
        echo json_encode(["error" => "Invalid input data."]);
    }

    $conn->close();
} else {
    echo json_encode(["error" => "Invalid request method."]);
}
?>
