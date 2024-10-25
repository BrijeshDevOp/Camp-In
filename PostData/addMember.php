<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["group_id"])) {
        $group_id = $_POST["group_id"];
        $user_id = $_POST["user_id"];
        $dbPath = __DIR__ . '/../Assets/db/database.php';
        require $dbPath;

        // Check if there's a membership request from the user for the group
        $checkRequestSql = "SELECT * FROM group_request_table WHERE user_id = ? AND group_id = ?";
        $stmtCheckRequest = $conn->prepare($checkRequestSql);
        $stmtCheckRequest->bind_param("ii", $user_id, $group_id);
        $stmtCheckRequest->execute();
        $resultCheckRequest = $stmtCheckRequest->get_result();

        if ($resultCheckRequest->num_rows > 0) {
            // Update the status of the request to "approved"
            $updateRequestSql = "UPDATE group_request_table SET status = 'approved' WHERE user_id = ? AND group_id = ?";
            $stmtUpdateRequest = $conn->prepare($updateRequestSql);
            $stmtUpdateRequest->bind_param("ii", $user_id, $group_id);

            if ($stmtUpdateRequest->execute()) {
                // Insert the user as a member of the group
                $isadmin = 0;
                $insertMemberSql = "INSERT INTO group_members (group_id, member_id,is_admin) VALUES (?, ?, ?)";
                $stmtInsertMember = $conn->prepare($insertMemberSql);
                $stmtInsertMember->bind_param("iii", $group_id, $user_id,$isadmin);

                if ($stmtInsertMember->execute()) {
                    $response = array("message" => "User added as a member");
                } else {
                    $response = array("message" => "Failed to add user as a member");
                }
            } else {
                $response = array("message" => "Failed to approve the membership request");
            }
        } else {
            $response = array("message" => "No membership request found for the user and group");
        }

        // Close the prepared statements
        $stmtCheckRequest->close();
        $stmtUpdateRequest->close();
        $stmtInsertMember->close();

        // Return JSON response
        header("Content-Type: application/json");
        echo json_encode($response);

        // Close the database connection
        $conn->close();
    } else {
        $response = array("message" => "Failed: Group ID not provided");
        header("Content-Type: application/json");
        echo json_encode($response);
    }
}
?>
