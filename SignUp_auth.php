<?php 
    include("connect.php");

    $uname = $_POST['uname'];
    $inst = $_POST['inst'];
    $dept = $_POST['dept'];
    $email = $_POST['email'];
    $mobno = $_POST['mobno'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $pass = $_POST['pass'];
    $utype = $_POST['utype'];
    if($utype == 'student') {
        $uinfo = $_POST['sem'];
        $udata = 'sem';
        $table = 'students';
    }
    else {
        $uinfo = $_POST['post'];
        $udata = 'post';
        $table = 'faculties';
    }

    $query = "select id from $table";
    $cmd = mysqli_query($con,$query);

    while($row = mysqli_fetch_array($cmd)) {
        $uid = $row['id'];
    }
    $uid++;
    
    $image = $_FILES["uimg"];

    // Check if file is uploaded successfully
    
        // Read file contents
        if ($image["error"] === UPLOAD_ERR_OK) {
            $imageData = file_get_contents($image["tmp_name"]);
            echo "image uploaded";
        }
        else {
            $imageData = NULL;
            echo "image not uploaded";
        }
        
        // Prepare and bind the INSERT statement
        $stmt = $con->prepare("INSERT INTO $table (pic,id,name,inst,dep,email,mob,state,city,pass,$udata) 
        VALUES (?,$uid,'$uname','$inst','$dept','$email',$mobno,'$state','$city','$pass','$uinfo')");
        $stmt->bind_param("s", $imageData);

        // Execute the statement
        if ($stmt->execute()) {
            echo "data uploaded successfully.";
        } else {
            echo "Error uploading data: " . $stmt->error;
        }

        // Close statement and database connection
        $stmt->close();
        $con->close();

    setcookie("userid",$uid,time() + (10 * 365 * 24 * 60 * 60));
    setcookie("username",$uname,time() + (10 * 365 * 24 * 60 * 60));
    
?>