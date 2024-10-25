<?php
$dbPath = __DIR__.'/../Assets/db/database.php';
require $dbPath;

function checkAdminStatus($userId, $groupId) {
    global $conn; // Assuming you have a database connection object

    $sql = "SELECT is_admin FROM group_members WHERE group_id = ? AND member_id = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        // Handle the query preparation error
        echo "Query preparation error: " . $conn->error;
        return false; // Return an appropriate value indicating failure
    }

    $stmt->bind_param("ii", $groupId, $userId);
    
    if (!$stmt->execute()) {
        // Handle the query execution error
        echo "Query execution error: " . $stmt->error;
        return false; // Return an appropriate value indicating failure
    }
    
    $stmt->bind_result($isAdmin);
    $stmt->fetch();
    $stmt->close();

    return $isAdmin === 1; // Return true if user is an admin, false otherwise
}
?>
