<?php 
    include("connect.php");

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
    $fid = $_COOKIE['userid'];

    

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

    $query = "select id from events order by id";
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
        $query = "INSERT INTO events (pic,imgType,id,`name`,`type`,reg_cost,`start`,`end`,reg_start,reg_end,prize1,prize2,prize3,`state`,city,loc,org,`min`,`max`,`desc`,rules,want_reg,is_big,f_id) 
        VALUES (?,?,$id,'$name','$etype',$rcost,'$estart','$eend','$rstart','$rend','$prize1','$prize2','$prize3','$state','$city','$loc','$org',$min,$max,'$overview','$rule',1,$is_big,$fid)";
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
        header("location:E_edit.php?id=$id");
?>
