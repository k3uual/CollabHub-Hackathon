<?php
    include("connect.php");

    $eid = $_GET['id'];
    if(!isset($_COOKIE['userid'])){
        header("location:../SignIn.php");
    }
    $sid = $_COOKIE['userid'];

    $query = "select * from involved where s_id = $sid AND c_id = $eid";
    $cmd = mysqli_query($con, $query);
    if($row = mysqli_fetch_array($cmd)){
        header("location:collabview.php?id=$eid&stat=enrolled");
    }
    else {
        if($inscmd = mysqli_query($con, "insert into involved(c_id, s_id, approved) values($eid, $sid, 0)"))
            header("location:collabview.php?id=$eid&stat=success");
    }
?>