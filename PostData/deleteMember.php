<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $user_id = $_POST["u_id"];
    $group_id = $_POST['g_id'];
    
    $dbPath = __DIR__ . '/../Assets/db/database.php';
    require $dbPath;

    // Delete pending group requests for the user
    $deleteRequestsSql = "DELETE FROM group_request_table WHERE user_id = ? AND group_id = ? AND status = 'pending'";
    $stmtDeleteRequests = $conn->prepare($deleteRequestsSql);
    $stmtDeleteRequests->bind_param("ii", $user_id, $group_id);

    if ($stmtDeleteRequests->execute()) {
        $response = array("message" => "Pending group requests deleted successfully.");
    } else {
        $response = array("message" => "Failed to delete pending group requests.");
    }

    // Close the prepared statement
    $stmtDeleteRequests->close();

    // Return JSON response
    header("Content-Type: application/json");
    echo json_encode($response);

    // Close the database connection
    $conn->close();
}
?>
