<html>
    <head>
        <title>
            Manage area - CollabHub
        </title>
    </head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../topbar.css">
    <link rel="stylesheet" href="../team.css">

    <body>
    <?php
            if(isset($_GET['invalid'])){
                $invalid = $_GET['invalid'];
                echo "<script> alert('Invalid $invalid'); </script>";
            }
            if(!isset($_COOKIE['userid'])){
                //header('location:../index1.html');
            }
            else{
                $id = $_COOKIE['userid'];
                $utype = $_COOKIE['usertype'];
                include('connect.php');
                $topq = "Select * from $utype where id=$id";
                $topcmd = mysqli_query($con,$topq);
                $toprow = mysqli_fetch_array($topcmd);
            }
        ?>
        <div id="topsection">
            <div class="topbar">
                <div id="left">
                    <img class="logotop" src="../Logo.png" alt="Logo">
                    
                    <span class="webnametop"><b>CollabHub</b></span>
                </div>
                <div id="navcontain">
                    <div class="nav lnav">Events</div>
                    <div class="nav midnav ">Collabs</div>
                    <div class="nav rnav">Issues</div>
                </div>
                <?php
                if(!$id){
                    ?>
                <div id="rightauth">
                    <div id="signinopt" onclick="document.location.href = 'SignIn.php'">Sign In</div>
                    <div id="signupopt" onclick="document.location.href = 'SignUp.html'">Sign Up</div>
                </div>
                <?php 
                }
                else {
                    ?>
                <div id="right">

                    <?php
                    if($toprow['pic'] != NULL){
                        $flag = 1;
                    ?>
                    <img class="pfp" src="../display_img.php?userid=<?php echo $_COOKIE['userid'];?>&usertype=students" alt="pfp">
                    <?php 
                    }
                    else {
                        $flag = 0;
                    ?>
                    <img class="pfp" src="../blank-pfp.png" alt="pfp">
                    <?php }?>
                    <span class="username"><?php echo $_COOKIE['username'];?></span>
                    <i class="bi-caret-down-fill pfparrow"></i>
                </div>
                <?php
                } ?>
            </div>
            <div id="menu">
                <div class="menuopt"><i class="bi-person micon"></i><div class="opttxt">My Profile</div></div>
                <div class="menuopt"><i class="bi-calendar-check micon"></i><div class="opttxt">My Events</div></div>
                <div class="menuopt"><i class="bi-people micon"></i><div class="opttxt">My Collabs</div></div>
                <div class="menuopt"><i class="bi-person-add micon"></i><div class="opttxt">My Team</div></div>
                <div class="menuopt"><i class="bi-plus-circle micon"></i><div class="opttxt">Organize</div></div>
                <div class="menuopt lastopt" onclick="document.location.href = '../SignOut.php'"><i class="bi-box-arrow-right micon"></i><div class="opttxt">Sign Out</div></div>
            </div>
        </div>
        <?php
        include("connect.php");

        $id = $_GET['id'];
        $query = "Select * from teams where id = $id";
        $cmd = mysqli_query($con, $query);
        $row = mysqli_fetch_array($cmd);
        ?>
        <div class="projcontain">
            <form action="teamedit.php?id=<?php echo $id;?>" method="post" class="addmem">
                <div class="txt">Add Members:</div>
                <?php  
                    $query2 = "select * from members where t_id = $id AND is_leader = 0";
                    $cmd2 = mysqli_query($con, $query2);
                    $count = mysqli_num_rows($cmd2);
                    
                    if(isset($_POST['total'])){
                        $count = $_POST['total'];
                    }
                ?>
                <input type="number" name="total" class="inp" id="num" min="0" value="<?php if($count > 0){?><?php echo $count; }else{?>0<?php }?>">
                <input type="submit" value="Add" class="btn" id="add">
            </form>
        <form action="T_update.php" method="post">
            
            <input type="text" class="inp" name="proj" placeholder="Project Name" value="<?php echo $row['proj'];?>" required>
            <?php
            
                $query = "select * from members where t_id = $id AND is_leader = 1";
                $lead = mysqli_query($con, $query);
                $rowlead = mysqli_fetch_array($lead);
            ?>
            <input type="number" class="inp" name="lead" placeholder="Leader ID" value="<?php echo $rowlead['s_id'];?>" required>
                
            <?php
            
            $i = 0;
            while($row2 = mysqli_fetch_array($cmd2)){
                if($count <= $i) {
                    break;
                }
            ?>
                <input type="number" class="inp" name="mem<?php echo $i;?>" placeholder="Member <?php echo $i + 1;?> ID" min="1" value="<?php echo $row2['s_id'];?>" required>
            <?php
            $i++;
            }
            

            while($count > $i){
            ?>
                <input type="number" class="inp" name="mem<?php echo $i;?>" placeholder="Member <?php echo $i + 1;?> ID" min="1" required>
            <?php
            $i++;
            }
            ?>
            <input type="number" class="inp" name="guide" placeholder="Guide ID" value="<?php echo $row['f_id'];?>" required>
            <textarea name="idea" id="info" cols="30" rows="10" placeholder="Project Description" required><?php echo $row['idea'];?></textarea>
            <input type="hidden" name="count" value="<?php echo $count;?>">
            <input type="hidden" name="id" value="<?php echo $row['id']?>">
            <input type="hidden" name="type" value="teams">
        </div>
        <div class="btncontain">
            <input type="hidden" name="id" value="<?php echo $row['id'];?>">
            <input type="submit" class="btn" id="edit" value='Edit Issue'>
        </form>
            <form action="../delete.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                <input type="hidden" name="table" value="teams">
                <input type="submit" class="btn" id="delete" value="Delete Issue">
            </form>
        </div>
    </body>
    <script>
        let profile = document.getElementById("right");
        console.log("hello");

        let profile2 = document.querySelector("#menu");
        let another = document.getElementById("menu");

        profile.addEventListener("click", function() {
            console.log("open");
            profile2.classList.toggle("open");
        });
    </script>
</html>