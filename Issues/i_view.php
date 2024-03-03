<html>
    <head>
        <title>Events - CollabHub</title>
    </head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../topbar.css">
    <style>
        body {
            background-color: #f5f7f7;
            font-family: "Nunito Sans", sans-serif;
            overflow: visible;
        }

        .name {
            left: 20px;
            font-size: 28px;
            text-decoration: underline;
        }

        .cmtcontain {
            display: flex;
            flex-direction: column;
            position: relative;
            top: 30px;
            margin-bottom: 50px;
            height: fit-content;
            background-color: white;
            width: 60%;
            padding: 20px 50px 30px 50px;
            border-radius: 20px;
        }
        .issuesection {
            display: flex;
            align-items: center;
            flex-direction: column;
        }
        .issue {
            display: flex;
            background-color: white;
            align-items: center;
            width: 70%;
            padding-bottom: 30px;
            border-radius: 20px;
        }

        .ienclose {
            position: relative;
            left: 20px;
            border-left: 2px solid #bababa;
            top: 15px;
        }
        
        .issuetxt {
            position: relative;
            left: 30px;
            top: -15px;
        }

        .description {
            font-size: 24px;
        }
        
        .cmt {
            width: 80%;
            position: relative;
            left: 15px;
            font-size: 18px;
        }

        .comment {
            position: relative;
            margin: 20px 0 20px 0;
            width: 100%;
        }

        .cmttop {
            display: flex;
            align-items: center;
            width: fit-content;
            position: relative;
            top: -10px;
        }

        .cmtpfp{
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }

        .vote {
            display: flex;
            flex-direction: column;
            position: relative;
            left: -6px;
            top: 8px;
        }

        .votecount {
            font-size: 12px;
            position: relative;
            right: -1.75px;
        }

        #addcmt {
            width: 100%;
        }

    </style>
    <body>
    <?php
            include('connect.php');
            if(!isset($_COOKIE['userid'])){
                //header('location:../index1.html');
            }
            else{
                $id = $_COOKIE['userid'];
                $utype = $_COOKIE['usertype'];
                
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
                <div class="menuopt"><i class="bi-person micon"></i><div class="opttxt" onclick="document.location.href = '<?php if($_COOKIE['usertype'] == 'students'){echo 'Students/S_edit.php';}else{echo 'Faculties/F_edit.php';}?>'">My Profile</div></div>
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
                <div class="menuopt"><i class="bi-person-add micon"></i><div class="opttxt" onclick="document.location.href = '../Students/selectTeam.php'">My Team</div></div>
                <div class="menuopt"><i class="bi-person-add micon"></i><div class="opttxt" onclick="document.location.href = 'issueManage.php'">My Issues</div></div>
                <?php
                    }
                }
                ?>
                <div class="menuopt lastopt" onclick="document.location.href = '../SignOut.php'"><i class="bi-box-arrow-right micon"></i><div class="opttxt">Sign Out</div></div>
            </div>
        </div>
        <?php
            
            $id = $_GET['id'];
            
            $query = "Select * from issues where id = $id";
            $cmd = mysqli_query($con, $query);
            $row = mysqli_fetch_array($cmd);
        ?>
        <div class="issuesection">
            
            <div class="issue">
                <div class="ienclose">
                    <div class="issuetxt">
                        <div class="title"><h1><?php echo $row['title'];?></h1></div>
                        <div class="description"><?php echo $row['desc'];?></div>
                    </div>
                </div>
            </div>
            <div class="cmtcontain">
                <div>
                    <form action="addsolution.php" method="post">
                        <textarea name="desc" id="addcmt" cols="30" rows="10"></textarea>
                        <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                        <input type="submit" class="inp" value="Post">
                    </form>
                </div>
                <?php
                    $query = "select sol.id, sol.desc, sol.date, CONCAT_WS('',f.id, s.id) uid,  CONCAT_WS('',f.name, s.name) uname, CONCAT_WS('',f.pic, s.pic) upic, 
                    CONCAT_WS('',f.imgType, s.imgType) uimgtype from solutions sol left outer join students s on sol.s_id = s.id left outer join faculties f on sol.f_id = f.id where sol.i_id = $id";
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