<?php
// Database conection
include('connect.php');

// Fetch image data from database
    if (isset($_GET['userid'])) {
        $type = $_GET['usertype'];
        $sql = "SELECT imgType,pic FROM $type WHERE id=?";
        $statement = $con->prepare($sql);
        $id = $_GET['userid'];
        $statement->bind_param("i", $id);
        $statement->execute() or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_connect_error());
        $result = $statement->get_result();

        $row = $result->fetch_assoc();
        header("Content-type: " . $row["imgType"]);
        echo $row["pic"];
    }
    else {
        //header('location:index1.html');
    }
?>
