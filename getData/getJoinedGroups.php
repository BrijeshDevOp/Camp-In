<?php
$dbPath = __DIR__.'/../Assets/db/database.php';
require $dbPath;

session_start();
$user_id = $_SESSION['u_id'];

// Prepare and execute the SQL query to fetch group data
$sql = "SELECT * FROM group_table
        WHERE group_id IN (
          SELECT group_id FROM group_members
          WHERE member_id = $user_id
        )";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $groups = array();

    while ($row = $result->fetch_assoc()) {
        $groups[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($groups);
} else {
    header('Content-Type: application/json', true, 404);
    echo json_encode(array('message' => 'No groups found.'));
}

$conn->close();
?>
