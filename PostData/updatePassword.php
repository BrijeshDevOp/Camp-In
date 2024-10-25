<?php
session_start(); // Start the session at the beginning

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $password = $_POST['password'];
    if($username)
    {
        if($password)
        {
            $dbPath = __DIR__.'/../Assets/db/database.php';
            require $dbPath;
            $pwd = password_hash($password,PASSWORD_DEFAULT); 
            $q = "UPDATE user SET password = '$pwd' WHERE username = '$username'";
            $sql = mysqli_query($conn,$q);
            if($q)
            {
                header("Content-Type: application/json");
        
                $response = array(
                    "status" => "success",
                    "username" => $username,
                    "password" => $password,
                    "message" => "password updated"
                );
                echo json_encode($response);
            }
            else
            {
                header("Content-Type: application/json");
        
                $response = array(
                    "status" => "fail",
                    "username" => $username,
                    "password" => $password,
                    "message" => "password update failed"
                );
                echo json_encode($response);
            }
          }
    }
    else
    {
        header("Content-Type: application/json");

        $response = array(
            "status" => "fail",
            "username" => "no session"
        );

        echo json_encode($response);
    }
}
else
{
    header("Content-Type: application/json");

        $response = array(
            "status" => "fail",
            "username" => "error"
        );

        echo json_encode($response);
}
?>
