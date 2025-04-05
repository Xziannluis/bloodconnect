<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $id = isset($_DELETE['id']) ? intval($_DELETE['id']) : null;

    if ($id) {
        $stmt = $conn->prepare("DELETE FROM donors WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute() && $stmt->affected_rows > 0) {
            echo json_encode(["message" => "Donor deleted successfully."]);
        } else {
            echo json_encode(["error" => "Failed to delete donor."]);
        }

        $stmt->close();
    } else {
        echo json_encode(["error" => "Invalid ID."]);
    }

    $conn->close();
} else {
    echo json_encode(["error" => "Invalid request method."]);
}
?>
