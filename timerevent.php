<?php
    include('connect.php');
    $nowcmd = mysqli_query($con, "Select now() as now");
    $runnow = mysqli_fetch_array($nowcmd);
    $now = $runnow['now'];
    $query = "Select *, TIMESTAMPDIFF(second, '$now', reg_start) as didstart, TIMESTAMPDIFF(day, '$now', reg_end) as dleft, TIMESTAMPDIFF(hour, '$now', reg_end) as hleft,
    TIMESTAMPDIFF(minute, '$now', reg_end) as mleft, TIMESTAMPDIFF(second, '$now', reg_end) as sleft from EVENTS;";
    $cmd = mysqli_query($con, $query);

    while ($row = mysqli_fetch_array($cmd)) {
        $noclick = 0;
        if ($row['dleft']) {
            $diff = $row['dleft'];
            $left = $row['dleft'] . ' Day';
        } elseif ($row['hleft']) {
            $diff = $row['hleft'];
            $left = $row['hleft'] . ' Hour';
        } elseif ($row['mleft']) {
            $diff = $row['mleft'];
            $left = $row['mleft'] . ' Minute';
        } elseif ($row['sleft']) {
            $diff = $row['sleft'];
            $left = $row['sleft'] . ' Second';
        } else {
            $diff = NULL;
            $left = NULL;
        }

        if ($row['didstart'] > 0)
            $noclick = 1;

        if ($diff > 1)
            $left .= 's';
?>
        <div class="card" onclick="document.location.href = 'Events/eventview.php?id=<?php echo $row['id']; ?>'">
            <div class="section imgsec">
                <?php if ($row['pic'] == NULL) { ?>
                    <div class="ele"><img class="eimg" src="blank-pfp.png" alt=""></div>
                <?php } else { ?>
                    <img class="eimg" src="display_img.php?userid=<?php echo $row['id']; ?>&usertype=events" alt="Event Image">
                <?php } ?>
            </div>
            <div class="section detsec">
                <div class="ele ename"><b><?php echo $row['name']; ?></b></div>
                <div class="details">
                    <div class="ele etype"><?php echo ' ' . $row['type']; ?></div>
                    <div class="ele mode"><i class="bi-geo-alt-fill"></i><?php echo ' ' . $row['loc']; ?></div>
                    <?php if ($noclick) { ?>
                        <div class="ele left end">Not Started</div>
                    <?php } elseif ($diff != NULL) { ?>
                        <div class="ele left" id="countdown-<?php echo $row['id']; ?>"><i class="bi-clock-fill"></i><?php echo ' ' . $left; ?> left</div>
                        <script>
                            // Countdown timer script
                            var countdown<?php echo $row['id']; ?> = <?php echo $diff; ?>;
                            setInterval(function() {
                                countdown<?php echo $row['id']; ?>--;
                                document.getElementById('countdown-<?php echo $row['id']; ?>').innerHTML = '<i class="bi-clock-fill"></i>' + countdown<?php echo $row['id']; ?> + ' Second left';
                            }, 1000);
                        </script>
                    <?php } else { ?>
                        <div class="ele left end">Ended</div>
                    <?php } ?>
                    <?php if ($row['prize1']) { ?>
                        <div class="ele prize"><i class="bi-trophy-fill"></i><b> <?php echo $row['prize1']; ?></b></div>
                    <?php } ?>
                </div>
            </div>
            <div class="section extrasec">
                <div class="ele eby"><i class="bi-flag-fill"></i><?php echo ' ' . $row['org']; ?></div>
                <?php
                    $date1 = strtotime($row['start']);
                    $start = date('d M', $date1);
                    $date2 = strtotime($row['end']);
                    $end = date('d M', $date2);
                ?>
                <div class="ele date"><i class="bi-calendar-fill"></i><?php echo ' ' . $start . ' - ' . $end; ?></div>
                <?php
                    $id = $row['id'];
                    $cmd2 = mysqli_query($con, "select count(*) as count from participates where e_id = $id");
                    $count = mysqli_fetch_array($cmd2);
                ?>
                <div class="ele epart"><i class="bi-people-fill"></i><b><?php echo ' ' . $count['count'] ?></b> Participating</div>
            </div>
        </div>
<?php }
?>
