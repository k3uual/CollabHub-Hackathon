<?php 
    include("connect.php");
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $loc = $_POST['loc'];
    $sid = $_COOKIE['userid'];

    $query = "select id from issues order by id";
    $cmd = mysqli_query($con,$query);

    while($row = mysqli_fetch_array($cmd)) {
        $id = $row['id'];
    }
    $id = $id + 1;

    
    $query = "INSERT INTO issues (id,title,loc,`desc`,`date`,s_id) 
    VALUES ($id,'$title','$loc','$desc',now(),$sid)";
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
