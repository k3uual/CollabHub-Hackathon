<?php
    include("connect.php");

    if(!isset($_COOKIE['userid'])){
        header("location:SignIn.php");
    }
    $type = $_COOKIE['usertype'];
    $cid = $_POST['id'];
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

    $query = "select id from comments order by id";
    $cmd = mysqli_query($con,$query);

    while($row = mysqli_fetch_array($cmd)) {
        $id = $row['id'];
    }
    $id = $id + 1;

    $query = "INSERT INTO comments (id,`desc`,`date`,`e_id`,$in,$no) 
    VALUES ($id,'$desc',now(),$cid,$uid,NULL)";
    echo $query;
    $cmd = mysqli_query($con, $query);

    header("location:eventview.php?id=$cid");
?>