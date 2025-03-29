<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db_connect.php';

    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['id'], $data['name'], $data['birthdate'], $data['gender'], $data['contact'], $data['bloodType'], $data['location'])) {
        $id = $data['id'];
        $name = $data['name'];
        $birthdate = $data['birthdate'];
        $gender = $data['gender'];
        $contact = $data['contact'];
        $bloodType = $data['bloodType'];
        $location = $data['location'];

        $stmt = $conn->prepare("UPDATE requests SET name = ?, birthdate = ?, gender = ?, contact = ?, blood_type = ?, location = ? WHERE id = ?");
        $stmt->bind_param("ssssssi", $name, $birthdate, $gender, $contact, $bloodType, $location, $id);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Request updated successfully."]);
        } else {
            echo json_encode(["error" => "Error updating request: " . $stmt->error]);
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
