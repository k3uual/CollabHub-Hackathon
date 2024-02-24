<?php
    include("connect.php");

    $uid = $_POST['uid'];
    $pass = $_POST['pass'];
    $query = "select s_id from students where s_id=$uid AND s_pass = '$pass'";
    $cmd = mysqli_query($con,$query);
    $row = mysqli_fetch_array($cmd);
    if(!$row) {
        header("location:SignIn.html");
    }
    else {
        setcookie("user",$_POST['uid'],time() + (10 * 365 * 24 * 60 * 60));
        echo $_COOKIE['user'];
        //header("location:check.php");
    }
?>