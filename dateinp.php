<html>
    <body>
        <form action="" method="post">
            <input type="datetime-local" name="dte">
            <input type="submit">
        </form>
    </body>
</html>

<?php
    if(isset($_POST['dte'])){
        $str = strtotime($_POST['dte']);
        $newformat = date('d M Y',$str);
        echo $newformat;
    }
?>