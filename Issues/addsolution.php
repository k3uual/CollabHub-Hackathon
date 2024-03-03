<?php
    include("connect.php");

    if(!isset($_COOKIE['userid'])){
        header("location:SignIn.php");
    }
    $type = $_COOKIE['usertype'];
    $iid = $_POST['id'];
    $uid = $_COOKIE['userid'];
    $desc = $_POST['desc'];

    if($type == 'students') {
        $in = "s_id";
        $no = "f_id";
    }
    else {
        $in = "f_id";
        $no = "s_id";
    }

    $query = "select id from solutions order by id";
    $cmd = mysqli_query($con,$query);

    while($row = mysqli_fetch_array($cmd)) {
        $id = $row['id'];
    }
    $id = $id + 1;

    $query = "INSERT INTO solutions (id,`desc`,`date`,`i_id`,$in,$no) 
    VALUES ($id,'$desc',now(),$iid,$uid,NULL)";
    echo $query;
    $cmd = mysqli_query($con, $query);

    header("location:i_view.php?id=$iid");
?>