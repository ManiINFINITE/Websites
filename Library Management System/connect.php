<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "businessdb";

    $conn = new mysqli($host, $user, $pass, $database);

    if ($conn -> connect_error) {
        echo "Failed to connect to database {$database} <br>" . $conn -> connect_error;
    }
?>