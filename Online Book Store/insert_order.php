<?php
session_start();
require_once 'db_connection.php'; // Ensure this points to your DB connection script

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection
    $servername = "localhost"; // Change if needed
    $username = "root"; // Your database username
    $password = "harini07"; // Your database password
    $dbname = "bookify_1"; // Your database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get JSON data from the request
    $data = json_decode(file_get_contents('php://input'), true);

    // Debugging output
    // Uncomment this to see the received data
    // var_dump($data); exit;

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO orders (username, order_received_date, ordered_items, order_delivery_date, total_price) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $data['username'], $data['order_received_date'], $data['ordered_items'], $data['order_delivery_date'], $data['total_price']);

    // Execute and check for errors
    $response = [];
    if ($stmt->execute()) {
        $_SESSION['order_received'] = true; // Set session variable to indicate order received
        $_SESSION['username'] = $data['username']; // Store username in session
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['error'] = $stmt->error; // Capture error message
        error_log("Order insertion failed: " . $stmt->error); // Log the error for debugging
    }

    $stmt->close();
    $conn->close();

    // Return response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
