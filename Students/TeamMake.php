<html>
    <head>
        <title>
            Manage Team - CollabHub
        </title>
    </head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../team.css">
    <link rel="stylesheet" href="../topbar.css">
    <style>
        .addmem {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .txt {
            font-size: 20px;
            margin-right: 10px;
        }

        #num {
            position: relative;
            top: 3px;
            width: 80px;
        }

        #add {
            position: relative;
            top: 1px;
            margin-left: 20px;
        }
    </style>
        

    <body>
    <?php
            if(!isset($_COOKIE['userid'])){
                //header('location:../index1.html');
            }
            else{
                $id = $_COOKIE['userid'];
                $utype = $_COOKIE['usertype'];
                include('connect.php');
                $query = "Select * from $utype where id=$id";
                $cmd = mysqli_query($con,$query);
                $row = mysqli_fetch_array($cmd);
            }
        ?>
        <div id="topsection">
            <div class="topbar">
                <div id="left" onclick="document.location.href = '../index2.php'">
                    <img class="logotop" src="../Logo.png" alt="Logo">
                    
                    <span class="webnametop"><b>CollabHub</b></span>
                </div>
                <div id="navcontain">
                    <div class="nav lnav" onclick="document.location.href = '../index2.php'">Events</div>
                    <div class="nav midnav" onclick="document.location.href = '../collab.php'">Collabs</div>
                    <div class="nav rnav" onclick="document.location.href = '../issue.php'">Issues</div>
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
                <div class="menuopt"><i class="bi-person micon"></i><div class="opttxt" onclick="document.location.href = '<?php if($_COOKIE['usertype'] == 'students'){echo 'S_edit.php';}else{echo 'F_edit.php';}?>'">My Profile</div></div>
                <?php
                if(isset($_COOKIE['usertype'])){
                    if($_COOKIE['usertype'] == "faculties"){
                ?>
                <div class="menuopt"><i class="bi-calendar-check micon"></i><div class="opttxt">My Events</div></div>
                <?php
                    }
                    else {
                ?>
                <div class="menuopt"><i class="bi-people micon"></i><div class="opttxt">My Collabs</div></div>
                <div class="menuopt"><i class="bi-person-add micon"></i><div class="opttxt">My Team</div></div>
                <div class="menuopt"><i class="bi-person-add micon"></i><div class="opttxt">My Issues</div></div>
                <?php
                    }
                }
                ?>
                <div class="menuopt lastopt" onclick="document.location.href = '../SignOut.php'"><i class="bi-box-arrow-right micon"></i><div class="opttxt">Sign Out</div></div>
            </div>
        </div>
        <?php
            $count = 0;
            if(isset($_GET['total'])){
                $count = $_GET['total'];
            }
        ?>
        <div class="projcontain">
        <form action="" method="get" class="addmem">
            <div class="txt">Add Members:</div>
            <input type="number" name="total" class="inp" id="num" min="0" value="<?php if($count > 0){?><?php echo $count; }else{?>0<?php }?>">
            <input type="submit" value="Add" class="btn" id="add">
        </form>
        <form action="teaminsert.php" method="post">
            
                <input type="text" class="inp" name="proj" placeholder="Project Name" required>
                
                <input type="number" class="inp" name="lead" placeholder="Leader ID" required>
            <?php
            $i = 0;
            while($count > $i){
            ?>
                <input type="number" class="inp" name="mem<?php echo $i;?>" placeholder="Member <?php echo $i + 1;?> ID" min="1" required>
            <?php
            $i++;
            }
            ?>
                <input type="number" class="inp" name="guide" placeholder="Guide ID" required>

                <textarea name="idea" id="info" cols="30" rows="10" placeholder="Project Description" required></textarea>
                
                <input type="hidden" name="count" value="<?php echo $count;?>">

                <div class="btncontain">
                    <input type="submit" class="btn" value="Make Team">
                </div>
            </div>
            
        </form>
    </body>

</html>