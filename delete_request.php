<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $id = isset($_DELETE['id']) ? intval($_DELETE['id']) : null;

    if ($id) {
        $stmt = $conn->prepare("DELETE FROM requests WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Request deleted successfully."]);
        } else {
            echo json_encode(["error" => "Error deleting request: " . $stmt->error]);
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
