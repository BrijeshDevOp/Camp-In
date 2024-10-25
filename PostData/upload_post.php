<?php
// Start the session
session_start();
$dbPath = __DIR__.'/../Assets/db/database.php';
require $dbPath;

function getGroupIdByName($conn, $groupName) {
    $groupName = $conn->real_escape_string($groupName); // Sanitize group name
    
    $sql = "SELECT group_id FROM group_table WHERE group_name = '$groupName'";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['group_id'];
    } else {
        return null;
    }
}


function isUserGroupAdmin($conn,$group_id, $user_id) {
    $group_id = $conn->real_escape_string($group_id);
    $user_id = $conn->real_escape_string($user_id);
    
    $sql = "SELECT admin_id FROM group_table WHERE group_id = '$group_id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return ($row['admin_id'] == $user_id);
    } else {
        return false; // Group not found or admin_id not matching
    }
}

function createPostInGroup($groupName, $userId, $img_url, $post_desc) {
    // Include database configuration
    $dbPath = __DIR__.'/../Assets/db/database.php';
    require $dbPath;

    // Create a database connection
    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $groupName = $conn->real_escape_string($groupName); // Sanitize group name
    $img_url = $conn->real_escape_string($img_url); // Sanitize content

    $groupId = getGroupIdByName($conn, $groupName);

    if ($groupId !== null) {

        $isAdmin = isUserGroupAdmin($conn,$groupId, $userId);

        if($isAdmin)
        {
            $sql = "INSERT INTO post (user_id, group_id, img_url, post_desc ,is_pending) VALUES ('$userId','$groupId','$img_url','$post_desc','0')";
        
            if ($conn->query($sql) === TRUE) {
                
                return true;
    
            } else {
                return false;
            }
        }
        else
        {
            $sql = "INSERT INTO post (user_id, group_id, img_url, post_desc) VALUES ('$userId','$groupId','$img_url','$post_desc')";
        
            if ($conn->query($sql) === TRUE) {
                
                return true;
    
            } else {
                return false;
            }
        }
       
    } else {
        return false; // Group not found
    }
}

// --------------------------------------------------------FUNCTION 4--------------------------------------------------------------------
function checkUserMembership($conn, $groupId, $userId) {
    $groupId = $conn->real_escape_string($groupId); // Sanitize group ID
    $userId = $conn->real_escape_string($userId); // Sanitize user ID
    
    $sql = "SELECT * FROM group_members WHERE group_id = '$groupId' AND member_id = '$userId'";
    $result = $conn->query($sql);
    
    return ($result->num_rows > 0);
}

// --------------------------------------------------------FUNCTION 4--------------------------------------------------------------------
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = array(); // Initialize an array to hold the response data
    
    // Check if the required form data is set
    if (isset($_FILES['imageFile']['tmp_name']) && isset($_POST['c_name']) && isset($_POST['post_desc'])) {
        // Retrieve form data
        $group_name = $_POST['c_name']; // Group name from the form
        $user_id = $_SESSION['u_id']; // User ID from the session
        $post_description = $_POST['post_desc']; // Post description from the form
        
        // Process uploaded image
        $sourceFilePath = $_FILES['imageFile']['tmp_name'];
        $destinationFolder = '../POSTS/';
        
        $originalFilename = $_FILES['imageFile']['name'];
        $extension = pathinfo($originalFilename, PATHINFO_EXTENSION);
        
        // Generate a unique filename using time and date
        $uniqueFilename = date('Ymd_His') . '_' . uniqid() . '.' . $extension;
        
        $destinationFilePath = $destinationFolder . $uniqueFilename; 
    
        // -------------------------------------------FUNCTION 1--------------------------------------------------------
       
        // Check if the group exists and get the posts_open_to_all value
        $groupId = getGroupIdByName($conn, $group_name); // Assuming $conn is your database connection

        // Check if the group ID is valid
        if ($groupId !== null) {
            // Retrieve the posts_open_to_all value from the group_table
            $sql = "SELECT posts_open_to_all FROM group_table WHERE group_id = '$groupId'";
            $result = $conn->query($sql);

            // Check if the result contains data
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $posts_open_to_all = $row['posts_open_to_all']; // Get the posts_open_to_all value

                // Check the value of posts_open_to_all
                if ($posts_open_to_all == 0) {
                    // Insert post and move image
                    if (createPostInGroup($group_name, $user_id, $destinationFilePath, $post_description)) {
                        if (move_uploaded_file($sourceFilePath, $destinationFilePath)) {
                            $response['message'] = 'Image moved successfully...POST-created successfully 0';
                        } else {
                            $response['message'] = 'Error moving image.';
                        }
                    } else {
                        $response['post_message'] = 'Error creating post or group not found.';
                    }
                } else if ($posts_open_to_all == 1) {
                    // Check if the user is a member of the group
                    $isMember = checkUserMembership($conn, $groupId, $user_id);

                    // Check the membership status
                    if ($isMember) {
                        // Insert post and move image
                        if (createPostInGroup($group_name, $user_id, $destinationFilePath, $post_description)) {
                            if (move_uploaded_file($sourceFilePath, $destinationFilePath)) {
                                $response['message'] = 'Image moved successfully...POST-created successfully 1';
                            } else {
                                $response['message'] = 'Error moving image.';
                            }
                        } else {
                            $response['post_message'] = 'Error creating post or group not found.';
                        }
                    } else {
                        $response['message'] = 'User is not a member of the group.';
                    }
                }
            } else {
                $response['message'] = 'Error retrieving group details.';
            }
        } else {
            $response['message'] = 'Group not found.';
        }
    } else {
        $response['message'] = 'Incomplete form data.';
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>