<?php
    setcookie("user",$_COOKIE['userid'],time() + (10 * 365 * 24 * 60 * 60) * -1);
    setcookie("username",$_COOKIE['username'],time() + (10 * 365 * 24 * 60 * 60) * -1);
?>