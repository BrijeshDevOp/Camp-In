<?php
// Replace with your database credentials
$dbPath = __DIR__.'/../Assets/db/database.php';
require $dbPath;

// Query to fetch an unread notification
$notification_sql = "SELECT * FROM notification WHERE is_read = 0 LIMIT 1";

$notification_result = $conn->query($notification_sql);

if ($notification_result->num_rows > 0) {
    $notification_row = $notification_result->fetch_assoc();
    $group_id = $notification_row['group_id'];

    // Get user_id from session or replace with the actual user_id
    session_start();
    $user_id = $_SESSION['u_id'];

    // Query to check membership
    $membership_sql = "SELECT COUNT(*) AS count FROM group_members WHERE member_id = $user_id AND group_id = $group_id";

    $membership_result = $conn->query($membership_sql);

    if ($membership_result->num_rows > 0) {
        $membership_row = $membership_result->fetch_assoc();
        $count = $membership_row["count"];

        if ($count > 0) {
            // Fetch additional data using JOINs
            $additional_data_sql = "
                SELECT n.*, u.username, g.group_name
                FROM notification n
                JOIN user u ON n.user_id = u.user_id
                JOIN group_table g ON n.group_id = g.group_id
                WHERE n.notification_id = " . $notification_row['notification_id'];

            $additional_data_result = $conn->query($additional_data_sql);

            if ($additional_data_result->num_rows > 0) {
                $additional_data_row = $additional_data_result->fetch_assoc();
                echo json_encode($additional_data_row);
            } else {
                echo json_encode(['message' => 'No notifications']);
            }
        } else {
            echo json_encode(['message' => 'No notifications']);
        }
    } else {
        echo json_encode(['error' => 'Error checking membership']);
    }
} else {
    echo json_encode(['message' => 'No notifications']);
}

?>
