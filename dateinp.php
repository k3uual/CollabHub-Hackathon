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
        $date = strtotime($_POST['dte']);
        $darr = getdate($date);
        var_dump($darr).'<br>';
        echo cal_days_in_month(CAL_GREGORIAN, $darr['mon'], $darr['year']);
    }
?>