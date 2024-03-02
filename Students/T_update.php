<?php
    include("connect.php");

    $id = $_POST['id'];
    $proj = $_POST['proj'];
    $idea = $_POST['idea'];
    $lead = $_POST['lead'];
    $guide = $_POST['guide'];
    $count = $_POST['count'];
    
    $query = "select id from teams order by id";
    $cmd = mysqli_query($con,$query);

    $invalid = 0;
    
    $query = "select * from students where id = $lead";
    $cmd = mysqli_query($con, $query);
    if(!$row = mysqli_fetch_array($cmd)){
        $invalid = 1;
        $invid = "Leader ID";
    }

    $query = "select * from faculties where id = $guide";
    $cmd = mysqli_query($con, $query);
    if(!$row = mysqli_fetch_array($cmd)){
        $invalid = 1;
        $invid = "Guide ID";
    }

    $i = 0;
    $j = 0;
    $mem = array();
    while($count > $i) {
        $member = $_POST["mem$i"];
        $query = "select * from students where id = $member";
        $cmd = mysqli_query($con, $query);
        if($row = mysqli_fetch_array($cmd)){
            array_push($mem, $_POST["mem$i"]);
            echo $mem[$j];
            $j++;
        }
        else {
            $invalid = 1;
            $invid = "Member ID";
        }
        $i++;
    }

    if($invalid)
        header("location:teamedit.php?id=$id&invalid=$invid");
    
    $query = "delete from teams where id = $id";
    mysqli_query($con, $query);

    $query = "insert into teams(id, proj, idea, approved, f_id, e_id) values($id, '$proj', '$idea', 0, $guide, NULL)";
    $cmd = mysqli_query($con, $query);

    $query = "insert into members(s_id, t_id, is_leader) values($lead, $id, 1)";
    $cmd = mysqli_query($con, $query);

    foreach($mem as $member) {
        $query = "insert ignore into members(s_id, t_id, is_leader) values($member, $id, 0)";
        $cmd = mysqli_query($con, $query);
    }
?>