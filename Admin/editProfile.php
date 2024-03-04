<?php
    include("connect.php");

    $id = $_POST['uid'];
    $uname = $_POST['uname'];
    
    $email = $_POST['email'];
    $mobno = $_POST['mobno'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $bio = $_POST['bio'];

    $pass = $_POST['pass'];
    setcookie("username",$uname,time() + (10 * 365 * 24 * 60 * 60));


    $query = "select id from admin";
    $cmd = mysqli_query($con,$query);

    while($row = mysqli_fetch_array($cmd)) {
        $uid = $row['id'];
    }
    $uid++;
    
    $image = $_FILES["uimg"];

    // Check if file is uploaded successfully
    
        // Read file contents
        if ($image["error"] === UPLOAD_ERR_OK) {
            $imageData = file_get_contents($_FILES["uimg"]["tmp_name"]);
            $fileType = $_FILES["uimg"]["type"];
        }
        
        // Prepare and bind the INSERT statement
        if($image['name'] == ''){
            $stmt = $con->prepare("UPDATE $utype SET name = '$uname', pass = '$pass', state = '$state', city = '$city', 
            email = '$email', mob = $mobno, `desc` = '$bio' WHERE id = $id");
        }
        else{
            $stmt = $con->prepare("UPDATE $utype SET pic = ?, imgType = ?, name = '$uname', pass = '$pass', state = '$state', city = '$city',
            email = '$email', mob = $mobno, `desc` = '$bio' WHERE id = $id");
            $stmt->bind_param("ss", $imageData, $fileType);
        }
        $stmt->execute();
        $stmt->close();

        header("location:$location");
?>