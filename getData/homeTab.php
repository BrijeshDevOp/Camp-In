<?php
$dbPath = __DIR__.'/../Assets/db/database.php';
require $dbPath;

session_start();
$userId = $_SESSION['u_id'];

$page = $_GET["page"];
$limit = $_GET["limit"];
$offset = ($page - 1) * $limit;

// Use prepared statements to prevent SQL injection
$sql = "SELECT 
    post.post_id,
    post.user_id,
    user.username,
    user.profile_url,
    post.group_id,
    group_table.group_name,
    post.img_url,
    post.post_desc,
    post.post_date,
    IFNULL(like_table.user_id, 0) AS liked,
    IFNULL(like_table.like_icon, '../ICONS/heart-regular.svg') AS like_icon,
    (SELECT COUNT(*) FROM like_table WHERE like_table.post_id = post.post_id) AS total_likes
FROM 
    post
JOIN 
    user ON post.user_id = user.user_id
JOIN
    group_table ON post.group_id = group_table.group_id
LEFT JOIN
    like_table ON post.post_id = like_table.post_id AND like_table.user_id = ?
WHERE
    post.group_id IN (SELECT group_id FROM group_members WHERE member_id = ?)
AND
    post.is_pending = 0
AND
    post.is_removed = 0
LIMIT ?, ?";


// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiii", $userId, $userId, $offset, $limit);
$stmt->execute();
$result = $stmt->get_result();

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$stmt->close(); // Close the prepared statement

$conn->close();

// Set appropriate response header
header('Content-Type: application/json');

// If there is no data, return a JSON response with a message
if (empty($data)) {
    $response = array("message" => "No data");
    echo json_encode($response);
} else {
    echo json_encode($data);
}
?>