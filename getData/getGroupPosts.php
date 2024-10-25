<?php
$dbPath = __DIR__.'/../Assets/db/database.php';
require $dbPath;

// Get the group_id from the query string or POST data, adjust as needed
$groupId = $_GET['group_id']; // Assuming you are passing the group_id as a query parameter

$sql = "SELECT 
            post.post_id,
            post.user_id,
            user.username,
            user.profile_url,
            post.group_id,
            group_table.group_name,
            post.img_url,
            post.post_desc,
            post.post_date
        FROM 
            post
        JOIN 
            user ON post.user_id = user.user_id
        JOIN
            group_table ON post.group_id = group_table.group_id
        WHERE
            post.group_id = $groupId"; // Filter by the specified group_id

$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Close the database connection
$conn->close();

// Convert data to JSON
$jsonData = json_encode($data);

// Return JSON response
header('Content-Type: application/json');
echo $jsonData;
?>
