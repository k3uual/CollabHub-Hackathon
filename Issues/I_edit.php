<html>
    <head>
        <title>
            Manage area - CollabHub
        </title>
    </head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../topbar.css">
    <link rel="stylesheet" href="../iedit.css">

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
            <div class="menuopt"><i class="bi-person micon"></i><div class="opttxt" onclick="document.location.href = '<?php if($_COOKIE['usertype'] == 'students'){echo '../Students/S_edit.php';}else{echo '../Faculties/F_edit.php';}?>'">My Profile</div></div>

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
        include("connect.php");

        $id = $_GET['id'];
        $query = "Select * from issues where id = $id";
        $cmd = mysqli_query($con, $query);
        $row = mysqli_fetch_array($cmd);
        ?>
        <form action="I_update.php" method="post">
            <div class="icontain">
                <fieldset>
                    <legend>Title</legend>
                    <input class="inp" type="text" name="title" placeholder="Title of the issue" value="<?php echo $row['title']?>">
                </fieldset>

                <fieldset>
                    <legend>Posting From</legend>
                    <input class="inp" type="text" name="loc" placeholder="Address" value="<?php echo $row['loc']?>">
                </fieldset>

                <fieldset class="infocontain">
                    <legend>Description</legend>
                    <textarea name="desc" id="info" cols="30" rows="10" placeholder="Describe issue"><?php echo $row['desc']?></textarea>
                </fieldset>

                <input type="hidden" name="id" value="<?php echo $row['id']?>">
            </div>
        <div class="btncontain">
            <input type="hidden" name="id" value="<?php echo $row['id'];?>">
            <input type="submit" class="btn" id="edit" value='Edit Issue'>
        </form>
            <form action="../delete.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                <input type="hidden" name="table" value="issues">
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