<?php

    setcookie("userid",'',time() + (-(10 * 365 * 24 * 60 * 60 *60)));
    setcookie("username",'',time() + (-(10 * 365 * 24 * 60 * 60 * 60)));
    setcookie("usertype",'',time() + (-(10 * 365 * 24 * 60 * 60)));
    echo $_COOKIE['usertype'];
    echo $_COOKIE['userid'];

    header("location:index2.php");
?>