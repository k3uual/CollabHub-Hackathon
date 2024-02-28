<html>
    <head>
        <title>Register</title>
    </head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../edit.css">
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
                $query = "Select * from $utype where id=$id";
                $cmd = mysqli_query($con,$query);
                $row = mysqli_fetch_array($cmd);
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
                    if($row['pic'] != NULL){
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
        <form action="../DoEdit.php" method="post" enctype="multipart/form-data">
        <div class="infosection">
            <div class="leftinfo">
                <div class="pfpcontain">
                    <?php 
                    if($flag){
                    ?>
                    <img id="pfp" src="../display_img.php?userid=<?php echo $_COOKIE['userid'];?>&usertype=students" alt="pfp">
                    <?php }
                    else{
                    ?>
                    <img id="pfp" src="../blank-pfp.png" for="pfp" ></img>
                    <?php }?>
                    <div class="bi bi-pencil-fill" id="chngpic" onclick="openfile()"></div>
                    <input type="file" id="openimg" accept="image/*" name="uimg" onchange="loadFile(event)">
                </div>

                <fieldset class="containinfo gnrinfo">
                    <legend>General</legend>
                    
                    <div class="label firsttxt">User-ID: </div>
                    <input class="inp readonly" type="text" name="uid" value="<?php echo $row['id'];?>" readonly>
                    
                    <div class="label firsttxt">Name: </div>
                    <input class="inp" type="text" placeholder="User Name" value="<?php echo $row['name'];?>" name="uname" >
                    
                    <div class="label">Institute Name: </div>
                    <input class="inp" type="text" placeholder="Institute Name" value="<?php echo $row['inst'];?>" name="inst" >
                    
                    <div class="label">Department Name: </div>
                    <input class="inp" type="text" placeholder="Department Name" value="<?php echo $row['dep'];?>" name="dept" >
                    
                    <div class="label">State: </div>
                    <input class="inp" type="text" placeholder="State" value="<?php echo $row['state'];?>" name="state">
                    
                    <div class="label lasttxt">City: </div>
                    <input class="inp" type="text" placeholder="City" value="<?php echo $row['city'];?>" name="city">
                    
                    <input type="button" onclick="document.location.href = '?uid='" class="btn" id="chng" value="Change Password">
                </fieldset>
            </div>
            <div class="rightinfo">
                <fieldset  class="containinfo cntinfo">
                    <legend>Contact</legend>
                    
                    <div class="label firsttxt">Email: </div>
                    <input class="inp" type="email" placeholder="Email" value="<?php echo $row['email'];?>" name="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" required>
                
                    <div class="label lasttxt">Mobile No.: </div>
                    <input class="inp" type="number" placeholder="Mobile No." value="<?php echo $row['mob'];?>" name="mobno" >
                    
                </fieldset>
            
                <fieldset class="containinfo bioinfo">
                    <legend>About you</legend>
                        <div class="label lasttxt">Post: </div>
                        <input class="inp" type="text" placeholder="Post" value="<?php echo $row['post'];?>" name="post">
                        
                        <div class="label firsttxt">Bio: </div>
                        <textarea name="bio" id="bioarea" cols="30" rows="10" placeholder="Add a Bio."><?php echo $row['desc'];?></textarea>
                </fieldset>
            </div>
        </div>
        <div class="btncontain">
            <input type="hidden" name="utype" value="<?php echo $utype;?>">
            <input type="submit" class="btn" id="edit" value='Edit Profile'>
        </form>
    </body>

        <form action="">
            <input type="hidden" name="userid" value="">
            <input type="submit" class="btn" id="delete" value="Delete Profile">
        </form>
    </div>

    <script>
        let profile = document.getElementById("right");
        console.log("hello");

        let profile2 = document.querySelector("#menu");
        let another = document.getElementById("menu");

        profile.addEventListener("click", function() {
            console.log("open");
            profile2.classList.toggle("open");
        });

        const fileUploadDiv = document.getElementById('chngpic');
        const fileInput = document.getElementById('openimg');
        fileUploadDiv.addEventListener('click', function() {
            fileInput.click();
        });

        let loadFile = function (event) {
            let image = document.getElementById("pfp");
            image.src = URL.createObjectURL(event.target.files[0]);
        };
        
    </script>
</html>