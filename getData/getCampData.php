<?php
$dbPath = __DIR__.'/../Assets/db/database.php';
require $dbPath;

$page = $_GET["page"];
$limit = $_GET["limit"];
$offset = ($page - 1) * $limit;

$groupId = $_GET["groupId"]; // Assuming you pass the groupId as a query parameter
$userId = $_GET["userId"];

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
            (SELECT COUNT(*) FROM like_table WHERE like_table.post_id = post.post_id) AS total_likes
        FROM 
            post
        JOIN 
            user ON post.user_id = user.user_id
        JOIN
            group_table ON post.group_id = group_table.group_id
        LEFT JOIN
            like_table ON post.post_id = like_table.post_id AND like_table.user_id = $userId
        WHERE
            post.group_id = $groupId
        AND
            post.is_pending = 0
        AND
            post.is_removed = 0
        LIMIT $offset, $limit";


$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

$jsonData = json_encode($data);

header('Content-Type: application/json');
echo $jsonData;
?>
