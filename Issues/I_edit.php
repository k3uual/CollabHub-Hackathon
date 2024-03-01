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
        <div id="topsection">
            <div class="topbar">
                <div id="left">
                    <img class="logotop" src="../Logo.png" alt="Logo">
                    <span class="webnametop"><b>CollabHub</b></span>
                </div>
                <div id="navcontain">
                    <div class="nav lnav ">Events</div>
                    <div class="nav midnav ">Collabs</div>
                    <div class="nav rnav">Issues</div>
                </div>
                
                <!-- <div id="rightauth">
                    <div id="signinopt" onclick="document.location.href = 'SignIn.php'">Sign In</div>
                    <div id="signupopt" onclick="document.location.href = 'SignUp.html'">Sign Up</div>
                </div> -->

                <div id="right">
                    <img class="pfp" src="../blank-pfp.png" alt="pfp">
                    <span class="username">Name</span>
                    <i class="bi-caret-down-fill pfparrow"></i>
                </div>
            </div>
            <div id="menu">
                <div class="menuopt"><i class="bi-person micon"></i><div class="opttxt">My Profile</div></div>
                <div class="menuopt"><i class="bi-calendar-check micon"></i><div class="opttxt">My Events</div></div>
                <div class="menuopt"><i class="bi-people micon"></i><div class="opttxt">My Collabs</div></div>
                <div class="menuopt"><i class="bi-person-add micon"></i><div class="opttxt">My Team</div></div>
                <div class="menuopt"><i class="bi-plus-circle micon"></i><div class="opttxt">Organize</div></div>
                <div class="menuopt lastopt"><i class="bi-box-arrow-right micon"></i><div class="opttxt">Sign Out</div></div>
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