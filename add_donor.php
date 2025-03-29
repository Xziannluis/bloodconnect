<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db_connect.php'; // Use db_connect.php for connection

    $name = $_POST['name'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $bloodType = $_POST['blood_type'];
    $location = $_POST['location'];

    // Validate inputs
    if (empty($name) || empty($birthdate) || empty($gender) || empty($contact) || empty($bloodType) || empty($location)) {
        echo "All fields are required.";
        exit;
    }

    // Insert donor data into the database
    $stmt = $conn->prepare("INSERT INTO donors (name, birthdate, gender, contact, blood_type, location) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $birthdate, $gender, $contact, $bloodType, $location);

    if ($stmt->execute()) {
        echo "Donor registered successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
