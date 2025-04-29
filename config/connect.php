<?php
    // db.
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "TugasWeek7";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
?>  