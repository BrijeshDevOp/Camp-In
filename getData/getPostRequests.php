<?php
// Establish the database connection
$dbPath = __DIR__.'/../Assets/db/database.php';
require $dbPath;

if (isset($_GET['group_id'])) {
    $group_id = $_GET['group_id'];

    // Fetch posts and user details for the specified group
    $query = "SELECT p.post_id, p.img_url, p.post_desc, p.is_pending, u.username, u.profile_url 
              FROM post p
              JOIN user u ON p.user_id = u.user_id
              WHERE p.group_id = ?";
              
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $group_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $pendingPosts = array();
    $foundPendingPosts = false;

    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['is_pending'] == 1) {
            $pendingPosts[] = $row;
            $foundPendingPosts = true;
        }
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);

    if (!$foundPendingPosts) {
        // No pending posts found, send a response message
        $response = array("message" => "No pending posts found for the specified group.");
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // Send the fetched pending posts as JSON response
        header('Content-Type: application/json');
        echo json_encode($pendingPosts);
    }
} else {
    $response = array("message" => "Group ID not provided.");
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Close the database connection
mysqli_close($conn);
?>
