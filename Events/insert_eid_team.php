<?php
    include("connect.php");

    $eid = $_GET['eid'];
    $tid = $_GET['tid'];

    $query = "select * from teams where id = $tid";
    $cmd = mysqli_query($con, $query);
    if($row = mysqli_fetch_array($cmd)){
        if($row["e_id"] != NULL) {
            header("location:eventview.php?id=$eid&stat=enrolled");
        }
        else {
            if($inscmd = mysqli_query($con, "UPDATE `teams` SET `e_id` = $eid WHERE `id` = $tid;")){
                header("location:eventview.php?id=$eid&stat=success");
            }
        }
    }
    
?>