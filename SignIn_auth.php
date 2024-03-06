<?php
    include("connect.php");

    $password = $_POST['pass'];
    $uid = $_POST['uid'];
    $type = $_POST['utype'];




    $query = "select id, pass, name from $type where id=$uid";
    echo $query;
    $cmd = mysqli_query($con,$query);
    $row = mysqli_fetch_array($cmd);
    
// Stored hashed password retrieved from the database
$storedHashedPassword = $row['pass'];

// Password entered by the user during login

$flag = 0;
// Verify the password using password_verify() function
if (password_verify($password, $storedHashedPassword)) {
    $flag = 1;
} 


// Stored hashed password retrieved from the database




    if(!$row && $flag) {
        header("location:SignIn.php?status=incorrect");
    }
    else {
        setcookie("userid",$_POST['uid'],time() + (10 * 365 * 24 * 60 * 60));
        setcookie("username",$row['name'],time() + (10 * 365 * 24 * 60 * 60));
        setcookie("usertype",$type,time() + (10 * 365 * 24 * 60 * 60));
        if($type == 'admin'){
            header("location:Admin/eventManage.php");
        }
        else{
            header("location:index2.php");
        }
    }
?>