<html>
    <head>
        <title>Issue - CollabHub</title>
    </head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../icard.css">
    <link rel="stylesheet" href="../topbar.css">
    <style>
        .icard, .titlecontain {
            cursor: default;
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
            width: 150px;
        }

        .btn:hover {
            background-color: rgb(11, 21, 165);
            transform: translate(0, -3px);
            transition: all 0.5s;
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
            <div class="menuopt"><i class="bi-person micon"></i><div class="opttxt" onclick="document.location.href = '<?php if($_COOKIE['usertype'] == 'students'){echo 'S_edit.php';}?>'">My Profile</div></div>

                <?php
                if(isset($_COOKIE['usertype'])){
                    if($_COOKIE['usertype'] == "faculties") {
                ?>
                <div class="menuopt"><i class="bi-calendar-check micon"></i><div class="opttxt" onclick="document.location.href = '../Events/eventManage.php'">My Events</div></div>
                <?php
                    }
                    else {
                ?>
                <div class="menuopt"><i class="bi-people micon"></i><div class="opttxt" onclick="document.location.href = '../Collabs/collabManage.php'">My Collabs</div></div>
                <div class="menuopt"><i class="bi-person-add micon"></i><div class="opttxt" onclick="document.location.href = 'selectTeam.php'">My Team</div></div>
                <div class="menuopt"><i class="bi-person-add micon"></i><div class="opttxt" onclick="document.location.href = '../Issues/issueManage.php'">My Issues</div></div>
                <?php
                    }
                }
                ?>
                <div class="menuopt lastopt" onclick="document.location.href = '../SignOut.php'"><i class="bi-box-arrow-right micon"></i><div class="opttxt">Sign Out</div></div>
            </div>
        </div>

        <div class="icardcontain">
            <?php
                include("connect.php");
                $sid = $_COOKIE['userid'];
                $query = "SELECT m.s_id, t.id, t.proj, t.idea, m.is_leader FROM members m INNER JOIN teams t on t.id = m.t_id WHERE m.s_id = $sid";
                $cmd = mysqli_query($con, $query);
                while($row = mysqli_fetch_array($cmd)) {
                    
            ?>
            <div class="icard">
                <div class="titlecontain">
                    <div class="title"><?php echo $row['proj'];?></div>
                </div>
                <div>
                    <button class="btn" onclick="document.location.href = 'teamedit.php?id=<?php echo $row['id'];?>'">Select</button>
                </div>
            </div>
            <?php
            }
            ?>
            <button class="btn" onclick="document.location.href = 'TeamMake.php'">Add</button>
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