<?php
// Database configuration
$dbPath = __DIR__.'/../Assets/db/database.php';
require $dbPath;
// Query to fetch required columns from the database
$sql = "SELECT  * FROM group_table";

// Execute the query and fetch the result
$result = $conn->query($sql);

// Check if the query was successful
if ($result->num_rows > 0) {
    $data = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($data);
} else {
    echo json_encode([]);
}

// Close the connection
$conn->close();
?>
