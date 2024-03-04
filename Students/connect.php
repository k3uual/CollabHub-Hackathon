<?php
    $con = mysqli_connect("localhost","root","","collab2");

    if ($con->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>