<?php
  $dbHost = 'localhost';
  $dbName = 'camp_in';
  $dbUser = 'root';
  $dbPassword = '';

  $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

        // Check if the connection was successful
        if ($conn->connect_error) {
            die("Database connection failed: " . $conn->connect_error);
        }
?>