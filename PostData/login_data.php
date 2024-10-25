<?php
session_start(); // Start the session at the beginning

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // $sql = "SELECT * FROM users where uname = '$uname' AND password = '$pwd'";
    $dbPath = __DIR__.'/../Assets/db/database.php';
    require $dbPath;

    $sql = "SELECT * FROM `user` WHERE `username` = '$username'";

    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result); // Check whether the username exists

    if ($num > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                $login = true;
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;

                header("Content-Type: application/json");

                $response = array(
                    "status" => "success",
                    "username" => $username,
                    "password" => $password
                );

                echo json_encode($response);
            } else {
                header("Content-Type: application/json");

                $response = array(
                    "status" => "fail",
                    "message" => "invalid password"
                );

                echo json_encode($response);
            }
        }
    } else {
        header("Content-Type: application/json");

        $response = array(
            "status" => "fail",
            "message" => "User doesnt exists "
        );

        echo json_encode($response);
    }
}
?>
