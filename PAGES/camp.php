<?php
session_start();
$userId = $_SESSION['u_id'];

$gid =  $_GET['g_id'];

// Check if the user is an admin of the group
$checkAdmin = __DIR__.'/../getData/checkAdmin.php';
require $checkAdmin;
$userIsAdmin = checkAdminStatus($userId, $gid);


if ($userIsAdmin) {
    $secretIdA = base64_encode($gid);
    header("Location: campA.php?g_id=$secretIdA");
} else {
    $secretIdM = base64_encode($gid);
    header("Location: campM.php?g_id=$secretIdM");
}
?>
