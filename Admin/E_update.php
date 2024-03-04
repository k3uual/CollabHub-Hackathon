<?php 
    include("connect.php");
    $id = $_POST['id'];
    $name = $_POST['ename'];
    $etype = $_POST['etype'];
    $rcost = $_POST['regcost'];
    $max = $_POST['max'];
    $min = $_POST['min'];
    
    $prize1 = $_POST['fprize'];
    $prize2 = $_POST['sprize'];
    $prize3 = $_POST['tprize'];
    $rstart = $_POST['regstart'];
    $rend = $_POST['regend'];
    $estart = $_POST['eventstart'];
    $eend = $_POST['eventend'];
    $overview = $_POST['overview'];
    $rule = $_POST['rule'];
    $org = $_POST['org'];
    

    if($_POST['venue'] == 'offline') {
        $state = $_POST['state'];
        $city = $_POST['city'];
        $loc = $_POST['loc'];
    }
    else {
        $state = 'online';
        $city = 'online';
        $loc = 'online';
    }

    if($max == '' || $min == ''){
        $max = 1;
        $min = 1;
    }

    if($max == 1 || $min == 1)
        $is_big = 0;
    else
        $is_big = 1;

    
    $image = $_FILES["uimg"];

        if ($image["error"] === UPLOAD_ERR_OK) {
            $imageData = file_get_contents($_FILES["uimg"]["tmp_name"]);
            $fileType = $_FILES["uimg"]["type"];
        }
        else {
            $imageData = NULL;
            $fileType = NULL;
        }
        
        // Prepare and bind the INSERT statement
        if($_FILES['uimg']['type'] == ''){
            $query = "UPDATE `events` SET `name` = '$name', `type` = '$etype', `reg_cost` = $rcost, `start` = '$estart', 
            `end` = '$eend', reg_start = '$rstart', reg_end = '$rend', `state` = '$state', city = '$city', `loc` = '$loc', `org` = '$org',
            prize1 = '$prize1', prize2 = '$prize2', prize3 = '$prize3', `min` = $min, `max` = $max, `desc` = '$overview', rules = '$rule', is_big = $is_big WHERE id = $id";
            echo $query;
            $stmt = $con->prepare($query);
        }
        else{
            $query = "UPDATE events SET pic = ?, imgType = ?, `name` = '$name', `type` = '$etype', `reg_cost` = $rcost, `start` = '$estart', 
            `end` = '$eend', reg_start = '$rstart', reg_end = '$rend', `state` = '$state', city = '$city', `loc` = '$loc', `org` = '$org',
            prize1 = '$prize1', prize2 = '$prize2', prize3 = '$prize3', `min` = $min, `max` = $max, `desc` = '$overview', rules = '$rule', is_big = $is_big WHERE id = $id";
            echo $query;
            $stmt = $con->prepare($query);
            $stmt->bind_param("ss", $imageData, $fileType);
        }
        if($stmt->execute())
            echo '<script>alert("Updated Successfully")</script>';
        else
            echo '<script>alert("Error Updating")</script>';
        $stmt->close();
        header("location:E_edit.php?id=$id");
?>
