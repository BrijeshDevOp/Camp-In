<?php

$dbPath = __DIR__.'/../Assets/db/database.php';
require $dbPath;

if($_SERVER["REQUEST_METHOD"] === "POST")
{
     if(isset($_POST["g_id"]) && isset($_POST['u_id']))
    {
        $gId = $_POST['g_id'];
        $uId = $_POST['u_id'];
        $groupId = $conn->real_escape_string($gId); // Sanitize group ID
        $userId = $conn->real_escape_string($uId); // Sanitize user ID
        
        $sql = "SELECT * FROM group_members WHERE group_id = '$groupId' AND member_id = '$userId'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $response = array("message" => "is  member");
        } else {
            $sqlGetGroupDetails = "SELECT posts_visible_to_all FROM group_table WHERE group_id = '$groupId'";
            $resultGetGroupDetails = $conn->query($sqlGetGroupDetails);
            
            if ($resultGetGroupDetails->num_rows > 0) {
                $row = $resultGetGroupDetails->fetch_assoc();
                $postsVisibleToAll = $row['posts_visible_to_all'];
                
                if ($postsVisibleToAll == 1) {
                    $response = array("message" => "is not a member", "visibility" => $postsVisibleToAll);
                } else {
                    $response = array("message" => "is not a member", "visibility" => $postsVisibleToAll);
                }
            } else {
                $response = array("message" => "Group not found");
            }
        }
        
        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}    
?>