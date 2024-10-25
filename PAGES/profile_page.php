<?php
    session_start();
    if(isset($_GET['user_id']))
    {
        $userId = $_SESSION['u_id'];
        $id = $_GET['user_id'];

        if($userId == $id)
        {
            header("Location: update_profile.php");
           
        }
    }
?>