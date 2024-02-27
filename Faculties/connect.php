<?php
    $con = mysqli_connect("localhost","root","","collab_hub");

    if ($con->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>