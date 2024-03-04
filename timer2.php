<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiple Timers using PHP</title>
</head>
<body>
    <?php
    // Define the number of divs and their IDs
    $numDivs = 5; // Change this to the desired number of divs
    $divIDs = array(); // Array to store div IDs
    for ($i = 1; $i <= $numDivs; $i++) {
        $divIDs[] = 'div_' . $i;
    }

    // Start time for each timer
    $startTimes = array();
    foreach ($divIDs as $divID) {
        $startTimes[$divID] = time();
    }

    // Function to calculate elapsed time
    function elapsedTime($start) {
        $elapsed = time() - $start;
        $hours = floor($elapsed / 3600);
        $minutes = floor(($elapsed % 3600) / 60);
        $seconds = $elapsed % 60;
        return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
    }
    ?>

    <?php foreach ($divIDs as $divID): ?>
        <div id="<?php echo $divID; ?>">
            Timer <?php echo substr($divID, 4); ?>: <span class="timer"></span>
        </div>
    <?php endforeach; ?>

    <script>
    // Update timers every second
    setInterval(function() {
        <?php foreach ($startTimes as $divID => $startTime): ?>
            // Fetch the elapsed time using PHP
            <?php
            echo "var elapsedTime" . $divID . " = '" . elapsedTime($startTime) . "';";
            ?>

            // Update the timer element
            document.getElementById('<?php echo $divID; ?>').getElementsByClassName('timer')[0].textContent = elapsedTime<?php echo $divID; ?>;
        <?php endforeach; ?>
    }, 1000);
    </script>
</body>
</html>
