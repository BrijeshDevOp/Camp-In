<?php
// Include your database connection
session_start();
$dbPath = __DIR__.'/../Assets/db/database.php';
require $dbPath;

$data = json_decode(file_get_contents('php://input'),true);

if (isset($data['postId'])) {
    $postId = $data['postId'];
    
    // Check if the user has already liked this post
    $userId = $_SESSION['u_id']; // Change this to your actual session variable for user ID
    $stmt = $conn->prepare("SELECT * FROM like_table WHERE post_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $postId, $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
            $stmt = $conn->prepare("DELETE FROM like_table WHERE post_id = ? AND user_id = ?");
            $stmt->bind_param("ii", $postId, $userId); // Bind parameters
            $stmt->execute(); // Execute the statement
            $stmt->close();
    } else {
            $like_icon = '../ICONS/heart-solid.svg';
            $stmt = $conn->prepare("INSERT INTO like_table (post_id, user_id, like_icon) VALUES (?, ?, ?)");
            $stmt->bind_param("iis", $postId, $userId, $like_icon); // Bind parameters
            $stmt->execute(); // Execute the statement
            $stmt->close();
    }

    // Fetch the updated like count and like icon
    $likesQuery = "SELECT 
                (SELECT COUNT(*) FROM like_table WHERE post_id = ?) AS like_count,
                IFNULL((SELECT like_icon FROM like_table WHERE post_id = ? AND user_id = ?), '../ICONS/heart-regular.svg') AS like_icon";
                $stmt = $conn->prepare($likesQuery);
                $stmt->bind_param("iii", $postId, $postId, $userId);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $likeCount = $row['like_count'];
                $likeIcon = $row['like_icon'];

                // Send the updated like count, like status, and like icon back to the client
                $response = array('likes' => $likeCount, 'isLiked' => ($likeIcon !== '../ICONS/heart-regular.svg'), 'likeIcon' => $likeIcon);
                echo json_encode($response);

                $stmt->close();

    
} else {
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
