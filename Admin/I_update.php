<?php 
    include("connect.php");
    $id = $_POST['id'];
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $loc = $_POST['loc'];
    $sid = $_COOKIE['userid'];

    
    $query = "UPDATE `issues` SET title = '$title', loc = '$loc', 
    `desc` = '$desc', `date` = now() WHERE id = 5003005";
    echo $query;
    // Prepare and bind the INSERT statement
    $stmt = $con->prepare($query);
    if($stmt->execute())
        echo 'alert("Posted successfully")';
    else
        echo 'alert(Error in posting)';
    $stmt->close();
    $con->close();
    header("location:I_edit.php?id=$id");
?>
