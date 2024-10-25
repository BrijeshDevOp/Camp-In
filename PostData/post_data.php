<?php
    if($_SERVER["REQUEST_METHOD"] === "POST")
    {
         if(isset($_POST["c_name"]) && isset($_POST["img_url"]) && isset($_POST["description"]))
        {
            $cname = $_POST["c_name"];
            $path = $_POST["img_url"];
            $descritpiom = $_POST["description"];
            
            $response = array("message" => "posted",
            "cname" => $cname,
            "path" => $path,
            "desc"=> $descritpiom
            );
            header("Content-Type: application/json");
            echo json_encode($response);
        }
        else
        {
            $response =  array("message" => "failed");
            header("Content-Type: application/json");
            echo json_encode($response);
        }
    }
?>