<?php 
    include("connect.php");
    $name = $_POST['ename'];
    $rcost = $_POST['regcost'];
    $rstart = $_POST['regstart'];
    $rend = $_POST['regend'];
    $estart = $_POST['eventstart'];
    $eend = $_POST['eventend'];
    $overview = $_POST['overview'];
    $rule = $_POST['rule'];
    $sid = $_COOKIE['userid'];

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

    $query = "select id from collabs order by id";
    $cmd = mysqli_query($con,$query);

    while($row = mysqli_fetch_array($cmd)) {
        $id = $row['id'];
    }
    $id = $id + 1;
    
    $image = $_FILES["uimg"];

        if ($image["error"] === UPLOAD_ERR_OK) {
            $imageData = file_get_contents($_FILES["uimg"]["tmp_name"]);
            $fileType = $_FILES["uimg"]["type"];
        }
        else {
            $imageData = NULL;
            $fileType = NULL;
        }
        $query = "INSERT INTO collabs (pic,imgType,id,`name`,reg_cost,`start`,`end`,reg_start,reg_end,`state`,city,loc,`desc`,rules,s_id) 
        VALUES (?,?,$id,'$name',$rcost,'$estart','$eend','$rstart','$rend','$state','$city','$loc','$overview','$rule',$sid)";
        echo $query;
        // Prepare and bind the INSERT statement
        $stmt = $con->prepare($query);
        $stmt->bind_param("ss", $imageData, $fileType);

        if($stmt->execute())
            echo 'alert("Posted successfully")';
        else
            echo 'alert(Error in posting)';

        $stmt->close();
        $con->close();
        header("location:collabedit.php?id=$id");
?>
