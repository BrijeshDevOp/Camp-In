<?php
// Make sure to set appropriate headers to indicate JSON response
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["username"] != '' &&  $_POST["password"] != '' && $_POST["cpassword"] != '' && $_POST["email"] != '') {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
        $email = $_POST["email"];

        // Your database connection details
        $dbPath = __DIR__.'/../Assets/db/database.php';
        require $dbPath;

        // Prepare the SQL query to check if the user exists in the table
        $checkUserQuery = "SELECT * FROM user WHERE username = '$username'";
        $result = $conn->query($checkUserQuery);

        if ($result->num_rows > 0) {
            // User already exists in the table
            header("Content-Type: application/json");
            $responseData = array(
                "status" => "fail",
                "message" => "Username already exists"
            );

            echo json_encode($responseData);
        } else {
            // User does not exist, perform any necessary data processing here before insertion (e.g., password hashing)

            // Prepare the SQL query to insert the data
            $pwd = password_hash($password,PASSWORD_DEFAULT); 
            $status = 1;
            $profile_url ="../Assets/images/profile.png";
            $insertQuery = "INSERT INTO `user` (username, password,email,profile_url,status) VALUES ('$username', '$pwd', '$email','$profile_url','$status')";

            // Execute the insertion query
            if ($conn->query($insertQuery) === TRUE) {
                header("Content-Type: application/json");
                // Create an associative array for the response data
                $responseData = array(
                    "status" => "success",
                    "message" => "User registered successfully",
                    "username" => $username,
                    "email" => $email,
                    "status" => $status
                );

                // Send the JSON response back
                echo json_encode($responseData);
            } else {
                // If the insertion fails, provide an error response
                $error = array(
                    "status" => "fail",
                    "message" => "Error inserting data: " . $conn->error
                );

                echo json_encode($error);
            }
        }

        // Close the database connection
        $conn->close();
    } else {
        $error = array(
            "status" => "fail",
            "message" => "Required fields are missing"
        );

        echo json_encode($error);
    }
}
?>
