<html>
    <head>
        <title>CollabHub</title>
    </head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../card.css">
    <link rel="stylesheet" href="../topbar.css">
    <style>
        .details {
            position: relative;
            top: 10px;
        }

        .btn {
            color: white;
            border: none;
            cursor: pointer;
            transition: all 1s;
            width: 50vh;
            padding: 8px;
            margin: 6px 0 6px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 20px;
            position: relative;
            background-color: rgb(55 112 255);
        }

        .btn:hover {
            transform: translate(0, -3px);
            transition: all 0.5s;
            background-color: rgb(55 112 255);
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
                    <div class="nav lnav " onclick="document.location.href = 'eventManage.php'">Events</div>
                    <div class="nav midnav selectednav">Collabs</div>
                    <div class="nav rnav" onclick="document.location.href = 'issueManage.php'">Issues</div>
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
                    <img class="pfp" src="../display_img.php?userid=<?php echo $_COOKIE['userid'];?>&usertype=<?php echo $_COOKIE['usertype'];?>" alt="pfp">
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
                <div class="menuopt"><i class="bi-person micon"></i><div class="opttxt" onclick="document.location.href = 'adminProfile.php'">My Profile</div></div>
                <div class="menuopt"><i class="bi-person micon"></i><div class="opttxt" onclick="document.location.href = 'studentManage.php'">Students</div></div>
                <div class="menuopt"><i class="bi-person micon"></i><div class="opttxt" onclick="document.location.href = 'facultyManage.php'">Faculties</div></div>
                
                <div class="menuopt lastopt" onclick="document.location.href = '../SignOut.php'"><i class="bi-box-arrow-right micon"></i><div class="opttxt">Sign Out</div></div>
            </div>
        </div>
        
        <div class="cardcontain">
        <?php
        include('connect.php');
        $nowcmd = mysqli_query($con,"Select now() as now");
        $runnow = mysqli_fetch_array($nowcmd);
        $now = $runnow['now'];
        $query = "Select *,TIMESTAMPDIFF(second,'$now',reg_start) as didstart,TIMESTAMPDIFF(day,'$now',reg_end) as dleft, TIMESTAMPDIFF(hour,'$now',reg_end) as hleft,
        TIMESTAMPDIFF(minute,'$now',reg_end) as mleft, TIMESTAMPDIFF(second,'$now',reg_end) as sleft from COLLABS";
        $cmd = mysqli_query($con, $query);
            
        while($row = mysqli_fetch_array($cmd)) {
            $noclick = 0;
            if($row['dleft']){
                $diff = $row['dleft'];
                $left = $row['dleft'].' Day';
            }
            elseif($row['hleft']) { 
                $diff = $row['hleft'];
                $left = $row['hleft'].' Hour';
            }
            elseif($row['mleft']) { 
                $diff = $row['mleft'];
                $left = $row['mleft'].' Minute';
            }
            elseif($row['sleft']) { 
                $diff = $row['sleft'];
                $left = $row['sleft'].' Second';
            }
            else {
                $diff = NULL;
                $left = NULL;
            }
            
            if($row['didstart'] > 0)
                $noclick = 1;

            if($diff > 1)
                $left .= 's';
        ?>
            <div class="card" onclick="document.location.href = 'collabedit.php?id=<?php echo $row['id'];?>'">
                <div class="section imgsec">
                    <?php if($row['pic'] == NULL){?>
                    <div class="ele" ><img class="eimg" src="../blank-pfp.png" alt=""></div>
                    <?php }
                    else {
                    ?>
                    <img class="eimg" src="../display_img.php?userid=<?php echo $row['id'];?>&usertype=collabs" alt="Collab Image">
                    <?php }?>
                </div>
                <div class="section detsec">
                    <div class="ele ename"><b><?php echo $row['name'];?></b></div>
                    <div class="details">
                        
                        <div class="ele mode"><i class="bi-geo-alt-fill"></i><?php echo ' '.$row['state'].','.$row['city'].','.$row['loc'];?></div>
                        <?php 
                        if($noclick){
                        ?>
                        <div class="ele left end">Not Started</div>
                        <?php 
                        } 
                        elseif($diff != NULL) {
                        ?>
                        <div class="ele left"><i class="bi-clock-fill"></i><?php echo ' '.$left;?> left</div>
                        <?php 
                        }
                        else {
                        ?>
                        <div class="ele left end">Ended</div>
                        <?php 
                        }
                        ?>
                    </div>
                </div>
                <div class="section extrasec">
                    
                    <?php 
                        $date1 = strtotime($row['start']);
                        $start = date('d M',$date1);
                        $date2 = strtotime($row['end']);
                        $end = date('d M',$date2);
                    ?>
                    <div class="ele date"><i class="bi-calendar-fill"></i><?php echo ' '.$start.' - '.$end;?></div>
                    <?php 
                    $id = $row['id'];
                    $cmd2 = mysqli_query($con,"select count(*) as count from participates where e_id = $id");
                    $count = mysqli_fetch_array($cmd2);
                    ?>
                    <div class="ele epart"><i class="bi-people-fill"></i><b><?php echo ' '.$count['count']?></b> Participating</div>
                </div>
            </div>
            <?php }
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

        // document.addEventListener("click", function() {
        //     console.log("close");
        //     profile2.classList.remove("open");
        // });
    </script>
</html>