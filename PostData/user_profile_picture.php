<?php
    session_start();
    $user_id = $_SESSION['u_id'];
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["file"])) {
    $uploadDir = "../PROFILE_IMAGES/"; // Specify your upload directory
    $uploadedFile = $_FILES["file"];
    
    // Generate a unique filename
    $filename = uniqid() . "_" . $uploadedFile["name"];
    $targetPath = $uploadDir . $filename;
    
    // Move the uploaded file to the target directory
    if (move_uploaded_file($uploadedFile["tmp_name"], $targetPath)) {
        $response = array("status" => "success", "message" => "File uploaded successfully.");

        $dbPath = __DIR__.'/../Assets/db/database.php';
        require $dbPath;

        $updateQuery = "UPDATE user SET profile_url = '$targetPath' WHERE user_id = '$user_id'";
        if ($conn->query($updateQuery) === TRUE) {
            $response = array("status" => "success", "message" => "Profile image updated.");
        } else {
            $response = array("status" => "error", "message" => "Database update failed.");
        }
        
        $conn->close();
    } else {
        $response = array("status" => "error", "message" => "Failed to upload file.");
    }
    
    header("Content-Type: application/json");
    echo json_encode($response);
}
?>
