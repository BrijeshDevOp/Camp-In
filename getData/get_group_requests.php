<?php
$dbPath = __DIR__.'/../Assets/db/database.php';
require $dbPath;

$group_id = $_GET['group_id'];

// Fetch pending group requests for the specified group along with user information
$query = "SELECT g.*, u.username, u.profile_url FROM group_request_table g
          JOIN user u ON g.user_id = u.user_id
          WHERE g.group_id = $group_id AND g.status = 'pending'";

$result = mysqli_query($conn, $query);

$response = array(); // Initialize response array

if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
    $response[] = $row;
  }
} else {
  $response['error'] = "Error fetching group requests: " . mysqli_error($conn);
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
mysqli_close($conn);
?>
