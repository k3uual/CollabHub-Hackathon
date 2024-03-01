<?php 
    include("connect.php");
    $id = $_POST['id'];
    $name = $_POST['ename'];
    $rcost = $_POST['regcost'];
    $rstart = $_POST['regstart'];
    $rend = $_POST['regend'];
    $estart = $_POST['eventstart'];
    $eend = $_POST['eventend'];
    $overview = $_POST['overview'];
    $rule = $_POST['rule'];
    

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

    if($max == 1 || $min == 1)
        $is_big = 1;
    else
        $is_big = 0;

    
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
            $query = "UPDATE collabs SET `name` = '$name', `reg_cost` = $rcost, `start` = '$estart', `end` = '$eend', 
            reg_start = '$rstart', reg_end = '$rend', `state` = '$state', city = '$city', `loc` = '$loc',`desc` = '$overview', rules = '$rule' WHERE id = $id";
            echo $query;
            $stmt = $con->prepare($query);
        }
        else{
            $query = "UPDATE collabs SET pic = ?, imgType = ?, `name` = '$name', `reg_cost` = $rcost, `start` = '$estart', `end` = '$eend', 
            reg_start = '$rstart', reg_end = '$rend', `state` = '$state', city = '$city', `loc` = '$loc',`desc` = '$overview', rules = '$rule' WHERE id = $id";
            echo $query;
            $stmt = $con->prepare($query);
            $stmt->bind_param("ss", $imageData, $fileType);
        }
        if($stmt->execute())
            echo '<script>alert("Updated Successfully")</script>';
        else
            echo '<script>alert("Error Updating")</script>';
        $stmt->close();
        header("location:collabedit.php?id=$id");
?>
