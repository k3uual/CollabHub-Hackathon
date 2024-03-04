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
                <div class="menuopt"><i class="bi-person micon"></i><div class="opttxt" onclick="document.location.href = 'adminProfile.php'">My Profile</div></div>
                <div class="menuopt"><i class="bi-person micon"></i><div class="opttxt" onclick="document.location.href = 'studentManage.php'">Students</div></div>
                <div class="menuopt"><i class="bi-person micon"></i><div class="opttxt" onclick="document.location.href = 'facultyManage.php'">Faculties</div></div>
                
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
                    <img id="pfp" src="../display_img.php?userid=<?php echo $_COOKIE['userid'];?>&usertype=faculties" alt="pfp">
                    <?php }
                    else{
                    ?>
                    <img id="pfp" src="../blank-pfp.png" for="pfp" ></img>
                    <?php }?>
                    <div class="bi bi-pencil-fill" id="chngpic" onclick="openfile()"></div>
                    <input type="file" id="openimg" accept="image/*" name="uimg" onchange="loadFile(event)">
                </div>
                <?php
                    $id = $_GET['id'];
                    $query = "Select * from faculties where id=$id";
                    $cmd = mysqli_query($con, $query);
                    $row = mysqli_fetch_array($cmd);
                ?>
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
                    
                    <div class="passcontain">
                        <input class="inp" type="password" placeholder="Password" id="typepass" name="pass" value="<?php echo $row['pass'];?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                        <div id="hidepass" onclick="togglePass()"><i id="eye" class="bi-eye-slash"></i></div>
                    </div>
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

    <form action="../delete.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                <input type="hidden" name="table" value="issues">
                <input type="submit" class="btn" id="delete" value="Delete Issue">
            </form>
    </div>

    <script>
        let profile = document.getElementById("right");
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
        
        function togglePass() {
            let temp = document.getElementById("typepass");
            let hide = document.getElementById("hidepass");

            if (temp.type === "password") {
                temp.type = "text";
                hide.innerHTML = `<i class="bi-eye" id="eye"></i>`;
            }
            else {
                temp.type = "password";
                hide.innerHTML = `<i class="bi-eye-slash" id="eye"></i>`;
            }
        }
        
    </script>
</html>