<html>
    <head>
        <title>Events - CollabHub</title>
    </head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../eview.css">
    <link rel="stylesheet" href="../topbar.css">

    <body>
    <?php
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
                if(!isset($_COOKIE['userid'])){
                    ?>
                <div id="rightauth">
                    <div id="signinopt" onclick="document.location.href = '../SignIn.php'">Sign In</div>
                    <div id="signupopt" onclick="document.location.href = '../SignUp.html'">Sign Up</div>
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
            include("connect.php");
            
            if(isset($_GET['stat'])) {
                $status = $_GET['stat'];
                if($status == "enrolled")
                    echo "<script> alert('Already Enrolled'); </script>";
                else
                    echo "<script> alert('Successfully Enrolled'); </script>";
            }

            $id = $_GET['id'];
            $nowcmd = mysqli_query($con,"Select now() as now");
            $runnow = mysqli_fetch_array($nowcmd);
            $now = $runnow['now'];
            $query = "Select *,TIMESTAMPDIFF(second,'$now',reg_start) as didstart,TIMESTAMPDIFF(day,'$now',reg_end) as dleft, 
            TIMESTAMPDIFF(hour,'$now',reg_end) as hleft, TIMESTAMPDIFF(minute,'$now',reg_end) as mleft, TIMESTAMPDIFF(second,'$now',reg_end) 
            as sleft from COLLABS where id = $id";
            $cmd = mysqli_query($con, $query);
            $row = mysqli_fetch_array($cmd);
        ?>
        <div class="toptitle">
            <?php 
            if($row['pic'] != NULL){
            ?>
            <img id="epic" src="../display_img.php?userid=<?php echo $row['id'];?>&usertype=events" alt="pfp">
            <?php
            }
            ?>
            <div class="name"><?php echo $row['name'];?></div>
        </div>
        <div class="enroll">
            <div class="ensec">
                <div class="entxt">Runs From:</div>
                <div class="entxt2">00 Feb - 00 Mar</div>
            </div>
            <div class="ensec">
                <div class="entxt">Happening At:</div>
                <?php
                if($row['state'] != 'online'){
                ?>
                <div class="entxt2"><?php echo $row['state'].', '.$row['city'].', '.$row['loc'];?></div>
                <?php
                }
                else {
                ?>
                <div class="entxt2"><?php echo $row['state']?></div>
                <?php
                }
                $fstart = strtotime($row['start']);
                $start = date("d M",$fstart);
                $fend = strtotime($row['end']);
                $end = date("d M",$fend);
                ?>
            </div>
            <div class="ensec">
                <div class="entxt">Closes in:</div>
                <div class="entxt2"><?php echo $start.' - '.$end;?></div>
            </div>
            <button class="enbtn" onclick="document.location.href = 'C_enroll.php?id=<?php echo $row['id'];?>'">Enroll Now</button>
        </div>
        <div class="infosec">
            <fieldset>
                <legend>Overview</legend>
                <div class="info"><?php echo $row['desc'];?></div>
            </fieldset>

            <fieldset>
                <legend>General</legend>

                <div class="label">Registration Cost:</div>
                <?php
                if($row['reg_cost'] == 0){
                ?>
                <div class="info">Nothing.</div>
                <?php
                }
                else {
                ?>
                <div class="info"><?php echo $row['reg_cost'];?></div>
                <?php
                }
                ?>
                <div class="label">Venue:</div>
                <div class="info"><?php echo $row['state'].', '.$row['city'].', '.$row['loc'];?></div>

            </fieldset>

            <fieldset>
                <legend>Dates</legend>
                <div class="label">Registration Starts:</div>
                <div class="info"><?php echo $row['reg_start'];?></div>

                <div class="label">Registration Ends:</div>
                <div class="info"><?php echo $row['reg_end'];?></div>

                <div class="label">Event Starts:</div>
                <div class="info"><?php echo $row['start'];?></div>

                <div class="label">Event Ends:</div>
                <div class="info"><?php echo $row['end'];?></div>
            </fieldset>

            <fieldset>
                <legend>Rules</legend>
                <div class="info"><?php echo $row['rules'];?></div>
            </fieldset>
        </div>
        <div class="cmtcontain">
                <div>
                    <form action="addcomment.php" method="post">
                        <textarea name="desc" id="addcmt" cols="30" rows="10"></textarea>
                        <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                        <input type="submit" class="inp" value="Post">
                    </form>
                </div>
                <?php
                    $query = "select sol.id, sol.desc, sol.date, CONCAT_WS('',f.id, s.id) uid,  CONCAT_WS('',f.name, s.name) uname, CONCAT_WS('',f.pic, s.pic) upic, 
                    CONCAT_WS('',f.imgType, s.imgType) uimgtype from comments sol left outer join students s on sol.s_id = s.id left outer join faculties f on sol.f_id = f.id where sol.c_id = $id";
                    $cmd = mysqli_query($con, $query);
                    while($row = mysqli_fetch_array($cmd)){
                ?>
                
                <div class="comment">
                    <div class="cmttop">
                        <div class="vote">
                            <i id="up" class="bi-caret-up"></i>
                            <i id="down" class="bi-caret-down"></i>
                            <div class="votecount">00</div>
                        </div>
                        <?php
                        if($row['upic'] != ''){        
                        ?>
                        <img class="pfp" src="../display_img.php?userid=<?php echo $row['uid'];?>&usertype=<?php if($row['uid']<2000000){echo "students";} else{echo "faculties";}?>" alt="pfp">
                        <?php
                        }
                        ?>
                        <img class="cmtpfp" src="../blank-pfp.png" alt="pfp">
                        <div class="username"><?php echo $row['uname'];?></div>
                    </div>

                    <div class="cmt"><?php echo $row['desc'];?></div>
                </div>
                <?php
                    }
                ?>
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