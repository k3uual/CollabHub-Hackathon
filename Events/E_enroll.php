<?php
    include("connect.php");

    $eid = $_GET['id'];
    if(!isset($_COOKIE['userid'])){
        header("location:../SignIn.php");
    }
    $sid = $_COOKIE['userid'];

    $isbig = mysqli_query($con, "select * from events where id = $eid AND is_big = 1");
    if($row = mysqli_fetch_array($isbig)){
        header("location:teamenroll.php?id=$eid");
    }
    
    else {
        $query = "select * from participates where s_id = $sid AND e_id = $eid";
        $cmd = mysqli_query($con, $query);
        if($row = mysqli_fetch_array($cmd)){
            header("location:eventview.php?id=$eid&stat=enrolled");
        }
        else {
            if($inscmd = mysqli_query($con, "insert into participates(s_id, e_id, approved) values($sid, $eid, 0)"))
                header("location:eventview.php?id=$eid&stat=success");
        }
    }
?>