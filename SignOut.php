<?php
    setcookie("user",$_COOKIE['user'],time() + (10 * 365 * 24 * 60 * 60) * -1);
?>