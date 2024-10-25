<?php
  session_start();

  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
  {
    header("location:Validate/login_form.php");
  }
  else
  {
    header("location:PAGES/mainpage.php");
  }
?>