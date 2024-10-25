<?php
// Establish the database connection
$dbPath = __DIR__.'/../Assets/db/database.php';
require $dbPath;

// Get the post ID from the form data
$post_id = $_POST['post_id'];

// Update the post's is_removed field to 1
$updateQuery = "UPDATE post SET is_removed = 1 WHERE post_id = ?";
$stmt = $conn->prepare($updateQuery);
$stmt->bind_param("i", $post_id);

$response = array();
if ($stmt->execute()) {
    $response['message'] = "Post successfully marked as removed.";
} else {
    $response['message'] = "Failed to mark post as removed.";
}

// Close the prepared statement
$stmt->close();

// Close the database connection
$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
