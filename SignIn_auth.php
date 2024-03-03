<?php
    include("connect.php");

    $uid = $_POST['uid'];
    $pass = $_POST['pass'];
    $type = $_POST['utype'];
    $query = "select id, name from $type where id=$uid AND pass = '$pass'";
    echo $query;
    $cmd = mysqli_query($con,$query);
    $row = mysqli_fetch_array($cmd);
    if(!$row) {
        header("location:SignIn.php?status=incorrect");
    }
    else {
        setcookie("userid",$_POST['uid'],time() + (10 * 365 * 24 * 60 * 60));
        setcookie("username",$row['name'],time() + (10 * 365 * 24 * 60 * 60));
        setcookie("usertype",$type,time() + (10 * 365 * 24 * 60 * 60));
        header("location:index2.php");
    }
?>