<?php
    include("connect.php");

    $id = $_POST['id'];
    $table = $_POST['table'];
    

    $query = "delete * from $table where id = $id";
    $cmd = mysqli_query($con, $query);
    $row = mysqli_fetch_array($cmd);
    if($row)
        echo "deleted";
    else
        echo "not";
?>