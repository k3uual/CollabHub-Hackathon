<html>
    <body>
    <table class="tbl-head" cellpadding="0" cellspacing="0" border="1">
        <tr>
            <th>Sid</th>
            <th>Name</th>
            <th>state</th>
            <th>city</th>
            <th>email</th>
            <th>Mobile No.</th>
            <th>dept</th>
            <th>sem</th>
        </tr>
        
    
<?php
    include ("connect.php");

    $query = "Select * from students where S_id = 1003003 and S_name = 'better'";
    $cmd = mysqli_query($con, $query);

    while($row = mysqli_fetch_array($cmd)) {
?> 
        <tr>
            <td><?php echo $row['s_id']?></td>
            <td><?php echo $row['s_name']?></td>
            <td><?php echo $row['s_state']?></td>
            <td><?php echo $row['s_city']?></td>
            <td><?php echo $row['s_email']?></td>
            <td><?php echo $row['s_mob']?></td>
            <td><?php echo $row['s_dep']?></td>
            <td><?php echo $row['s_sem']?></td>
        </tr>
        <?php }?>
        <?php 
            $query = "Select * from faculties";
            $cmd = mysqli_query($con, $query);
            while($row = mysqli_fetch_array($cmd)) {
        ?>
        <tr>
            <td><?php echo $row['f_id']?></td>
            <td><?php echo $row['f_name']?></td>
            <td><?php echo $row['f_state']?></td>
            <td><?php echo $row['f_city']?></td>
            <td><?php echo $row['f_email']?></td>
            <td><?php echo $row['f_mob']?></td>
            <td><?php echo $row['f_dep']?></td>
            <td><?php echo $row['f_post']?></td>
        </tr>
        <?php } ?>
    </table>
    </body>
</html>