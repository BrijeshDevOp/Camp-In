<?php
       if($_SERVER["REQUEST_METHOD"] === "POST")
       {
            if(isset($_POST["group_id"]))
           {
               $g_id = $_POST["group_id"];

               $dbPath = __DIR__.'/../Assets/db/database.php';
               require $dbPath;
          
               
               $sql = "SELECT group_name, icon_url , icon_color  FROM group_table WHERE group_id = '$g_id'";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $groupInfo = array(
                        'group_name' => $row['group_name'],
                        'group_icon' => $row['icon_url'],
                        'group_icon_color' => $row['icon_color']
                    );
                    echo json_encode($groupInfo);
                } else {
                    echo json_encode(array('error' => 'Group not found'));
                }

                // Close the database connection
                $conn->close();
           }
           else
           {
               $response =  array("message" => "failed");
               header("Content-Type: application/json");
               echo json_encode($response);
           }
       }
?>