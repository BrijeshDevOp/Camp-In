<?php
session_start();

$user_id =  $_SESSION['u_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["group_id"])) {
        $g_id = $_POST["group_id"];

        $dbPath = __DIR__.'/../Assets/db/database.php';
        require $dbPath;

        // Check if the request already exists
        $checkSql = "SELECT * FROM group_request_table WHERE user_id = $user_id AND group_id = $g_id";
        $result = $conn->query($checkSql);

        if ($result->num_rows > 0) {
            $response =  array(
                "status" => "success",
                "message" => "Request already exists");
            header("Content-Type: application/json");
            echo json_encode($response);
        } else {
            $sql = "INSERT INTO group_request_table (user_id, group_id, request_date, status)
                    VALUES ($user_id, $g_id, NOW(), 'pending')";

            if ($conn->query($sql) === TRUE) {
                $response =  array(
                    "status" => "success",
                    "message" => "Request Sent");
                header("Content-Type: application/json");
                echo json_encode($response);
            } else {
                echo "Error sending join request: " . $conn->error;
                $response =  array(
                    "status" => "failed",
                    "message" => "Request Send Failed");
                header("Content-Type: application/json");
                echo json_encode($response);
            }
        }

        // Close the database connection
        $conn->close();
    } else {
        $response =  array(
            "status" => "failed",
            "message" => "failed");
        header("Content-Type: application/json");
        echo json_encode($response);
    }
}
?>
