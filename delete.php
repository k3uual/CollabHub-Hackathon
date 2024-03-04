<?php
    include("connect.php");

    $id = $_POST['id'];
    $table = $_POST['table'];
    

    $query = "delete from $table where id = $id";
    echo $query;
    $cmd = mysqli_query($con, $query);
    if($cmd)
        echo '<script>alert("Deleted Successfully")</script>';
    else
        echo '<script>alert("Error Deleting")</script>';
    header("location:index2.php");
?>