<?php
// Retrieve the group ID from the POST request
$groupId = $_POST['g_id'];

$dbPath = __DIR__.'/../Assets/db/database.php';
require $dbPath;
// Prepare and execute SQL query
$sql = "SELECT * FROM group_table WHERE group_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $groupId); // 'i' indicates integer type

$response = array();

if ($stmt->execute()) {
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $response = $row;
    } else {
        $response = array(
            'error' => 'No group found with the given ID'
        );
    }
} else {
    $response = array(
        'error' => 'Query execution failed'
    );
}

$stmt->close();
$conn->close();

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
