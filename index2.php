<html>
    <head>
        <title>CollabHub</title>
    </head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="card.css">
    <link rel="stylesheet" href="topbar.css">
<?php
    include('connect.php');
    $query = "Select * from events";
    $cmd = mysqli_query($con, $query);
    
?>
    <body>
        <div id="topsection">
            <div class="topbar">
                <div id="left">
                    <img class="logotop" src="Logo.png" alt="Logo">
                    <span class="webnametop"><b>CollabHub</b></span>
                </div>
                <div id="navcontain">
                    <div class="nav lnav selectednav">Events</div>
                    <div class="nav midnav ">Collabs</div>
                    <div class="nav rnav">Issues</div>
                </div>
                
                <!-- <div id="rightauth">
                    <div id="signinopt" onclick="document.location.href = 'SignIn.php'">Sign In</div>
                    <div id="signupopt" onclick="document.location.href = 'SignUp.html'">Sign Up</div>
                </div> -->

                <div id="right">
                    <img class="pfp" src="blank-pfp.png" alt="pfp">
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
        
        <div class="cardcontain">
        <?php
        while($row = mysqli_fetch_array($cmd)) {
        ?>
            <div class="card">
                <div class="section imgsec">
                    <?php if($row['pic'] == NULL){?>
                    <div class="ele" ><img class="eimg" src="blank-pfp.png" alt=""></div>
                    <?php }
                    else {
                    ?>
                    <img class="eimg" src="display_img.php?userid=<?php echo $row['id'];?>&usertype=events" alt="Event Image">
                    <?php }?>
                </div>
                <div class="section detsec">
                    <div class="ele ename"><b><?php echo $row['name'];?></b></div>
                    <div class="details">
                        <div class="ele etype"><?php echo ' '.$row['type']; ?></div>
                        <div class="ele mode"><i class="bi-geo-alt-fill"></i><?php echo ' '.$row['loc'];?></div>
                        <div class="ele left"><i class="bi-clock-fill"></i> 0 days left</div>
                        <?php if($row['prize1']){?>
                        <div class="ele prize"><i class="bi-trophy-fill"></i><b> <?php echo $row['prize1'];?></b></div>
                        <?php }?>
                    </div>
                </div>
                <div class="section extrasec">
                    <div class="ele eby"><i class="bi-flag-fill"></i> Some org</div>
                    <div class="ele date"><i class="bi-calendar-fill"></i> 00 jan - 00 july</div>
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