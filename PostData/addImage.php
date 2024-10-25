<?php
// Assuming you have a database connection established
// Include necessary files and set up your database connection

$dbPath = __DIR__.'/../Assets/db/database.php';
require $dbPath;

if (isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];

    // Update the is_pending column for the specified post_id
    $query = "UPDATE post SET is_pending = 0 WHERE post_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $post_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $response = array("message" => "is_pending updated successfully.");
    } else {
        $response = array("message" => "Failed to update is_pending.");
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = array("message" => "Post ID not provided.");
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Close the database connection
mysqli_close($conn);
?>
