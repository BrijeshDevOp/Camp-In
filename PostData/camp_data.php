<?php
session_start();

$u_id = $_SESSION['u_id'];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["c_name"]) && isset($_POST["c_desc"]) && isset($_POST["c_access"]) && isset($_POST["c_visible"]) && isset($_POST["c_i_url"]) && isset($_POST["c_i_color"]) && isset($_POST["c_theme"])) {
        $cname = $_POST["c_name"];
        $c_desc = $_POST["c_desc"];
        $c_access = $_POST["c_access"];
        $c_visible = $_POST["c_visible"];
        $c_i_url = $_POST["c_i_url"];
        $c_i_color = $_POST["c_i_color"];
        $c_theme = $_POST["c_theme"];

        $dbPath = __DIR__ . '/../Assets/db/database.php';
        require $dbPath;

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the group name already exists
        $checkSql = "SELECT group_id FROM group_table WHERE group_name = '$cname'";
        $result = $conn->query($checkSql);

        if ($result->num_rows > 0) {
            header("Content-Type: application/json");

            $response = array(
                "response" => "failed",
                "message" => "Group name already exists");
            echo json_encode($response);
        } else {
            $insertSql = "INSERT INTO group_table (group_name, description, admin_id, created_by, posts_open_to_all, posts_visible_to_all, icon_url, icon_color, c_theme)
                        VALUES ('$cname','$c_desc','$u_id','$u_id','$c_access','$c_visible','$c_i_url','$c_i_color','$c_theme')";

            if ($conn->query($insertSql) === TRUE) {

                $insertedGroupId = $conn->insert_id;
                if ($insertedGroupId > 0) {
                    $sqlInsertMembership = "INSERT INTO group_members (group_id, member_id,is_admin) VALUES ('$insertedGroupId', '$u_id','1')";

                    if ($conn->query($sqlInsertMembership) === TRUE) {

                        header("Content-Type: application/json");

                        $response = array(
                            "response" => "success",
                            "message" => "Group posted",
                            "c_name" => $cname,
                            "c_id" => $insertedGroupId,
                            "c_desc" => $c_desc,
                            "c_access" => $c_access,
                            "c_visible" => $c_visible,
                            "c_i_url" => $c_i_url,
                            "c_i_color" => $c_i_color,
                            "c_theme" => $c_theme
                        );

                        echo json_encode($response);
                    } else {
                        $response = array(
                            "response" => "failed",
                            "message" => "Failed to create group");
                        echo json_encode($response);
                    }
                }
            } else {
                header("Content-Type: application/json");

                $response = array(
                    "response" => "failed",
                    "message" => "Failed to post group");
                echo json_encode($response);
            }
        }

        $conn->close();
    } else {
        $response = array(
            "response" => "failed",
            "message" => "Incomplete data");
        header("Content-Type: application/json");
        echo json_encode($response);
    }
}
?>
