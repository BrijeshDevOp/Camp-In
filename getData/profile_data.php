<?php
// Include your database connection code here

// Get user ID from the request
$user_id = $_GET['user_id'];

// Create a new mysqli connection
$dbPath = __DIR__.'/../Assets/db/database.php';
require $dbPath;

// Query to fetch user data
$query = "SELECT u.username, u.profile_url,
          COALESCE((SELECT COUNT(*) FROM post WHERE user_id = ?), 0) AS post_count,
          COALESCE((SELECT COUNT(*) FROM group_members WHERE member_id = ?), 0) AS group_count
          FROM user u
          WHERE u.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('iii', $user_id, $user_id, $user_id);
$stmt->execute();
$stmt->bind_result($username, $profile_url, $post_count, $group_count);
$stmt->fetch();

// Create an array to hold the user data
$user_data = array(
    "username" => $username,
    "profile_url" => $profile_url,
    "post_count" => $post_count,
    "group_count" => $group_count
);

// Close the statement and connection
$stmt->close();
$conn->close();

// Return the user data as JSON
header('Content-Type: application/json');
echo json_encode($user_data);
?>
