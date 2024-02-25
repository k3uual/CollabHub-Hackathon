<?php
    include("connect.php");

    $uid = $_POST['uid'];
    $pass = $_POST['pass'];
    $query = "select id, name from students where id=$uid AND pass = '$pass'";
    $cmd = mysqli_query($con,$query);
    $row = mysqli_fetch_array($cmd);
    if(!$row) {
        header("location:SignIn2.php?status=incorrect");
    }
    else {
        setcookie("userid",$_POST['uid'],time() + (10 * 365 * 24 * 60 * 60));
        setcookie("username",$row['name'],time() + (10 * 365 * 24 * 60 * 60));
        //header("location:check.php");
    }
?>