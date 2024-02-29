<html>
    <head>
        <title>
            Manage area - CollabHub
        </title>
    </head>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../eventedit.css">
    <link rel="stylesheet" href="../topbar.css">

    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
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
                <div class="menuopt"><i class="bi-person micon"></i><div class="opttxt">My Profile</div></div>
                <div class="menuopt"><i class="bi-calendar-check micon"></i><div class="opttxt">My Events</div></div>
                <div class="menuopt"><i class="bi-people micon"></i><div class="opttxt">My Collabs</div></div>
                <div class="menuopt"><i class="bi-person-add micon"></i><div class="opttxt">My Team</div></div>
                <div class="menuopt"><i class="bi-plus-circle micon"></i><div class="opttxt">Organize</div></div>
                <div class="menuopt lastopt" onclick="document.location.href = '../SignOut.php'"><i class="bi-box-arrow-right micon"></i><div class="opttxt">Sign Out</div></div>
            </div>
        </div>
        <div action="Login.html" method="post" enctype="multipart/form-data">
        <div class="infosection" >
            <div class="leftinfo">
                <div class="pfpcontain">
                    <img id="pfp" src="../blank-pfp.png" for="pfp" ></img>
                    <div class="bi bi-pencil-fill" id="chngpic" onclick="openfile()"></div>
                    <input type="file" id="openimg" accept="image/*" name="uimg" onchange="loadFile(event)">
                </div>

                <fieldset class="containinfo gnrinfo">
                    <legend>General</legend>

                    <div class="label">Name of Event:</div>
                    <input type="text" class="inp" name="ename">

                    <div class="label">Type of Event:</div>
                    <input type="text" class="inp" name="etype">

                    <div class="label">Registration Cost:</div>
                    <input type="number" class="inp" name="regcost">

                    <div class="label">Maximum number of members:</div>
                    <input type="number" class="inp" name="max">
                    
                    <div class="label">Mininmum number of members:</div>
                    <input type="number" class="inp" name="min">

                    <div class="label">Venue of Event:</div>
                    <div class="radios">
                        <label class="radele" for="online">
                            <input class="type" id="online" type="radio" name="utype" value="online" checked>Online
                        </label>
                        <label class="radele" for="offline">
                            <input class="type" id="offline" type="radio" name="utype" value="offline">Offline
                        </label>
                    </div>
                    
                    <div class="label">City:</div>
                    <input type="text" class="inp" name="city">
                
                    <div class="label">State:</div>
                    <input type="text" class="inp" name="state">
                    

                </fieldset>
            
            
                <fieldset  class="containinfo prizeinfo">
                    <legend>Prizes</legend>
                    
                    <div class="label">First Prize:</div>
                    <input type="text" class="inp" name="fprize">

                    <div class="label">Second Prize:</div>
                    <input type="text" class="inp" name="sprize">

                    <div class="label">Third Prize:</div>
                    <input type="text" class="inp" name="tprize">
                    
                </fieldset>
            </div>
            <div class="rightinfo">
                <fieldset class="containinfo dateinfo">
                    <legend>Dates</legend>
                    
                    <div class="label">Registration Starts At:</div>
                    <input type="datetime-local" class="inp" name="regstart">
        
                    <div class="label">Registration Ends At:</div>
                    <input type="datetime-local" class="inp" name="regends">
        
                    <div class="label">Event Starts At:</div>
                    <input type="datetime-local" class="inp" name="eventstarts">
        
                    <div class="label">Event Ends At:</div>
                    <input type="datetime-local" class="inp" name="eventends">
                </fieldset>

                <fieldset class="containinfo introinfo">
                    <legend>Overview</legend>
                    <div class="label">Overview of Event:</div>
                    <textarea name="overview" id="overview" cols="30" rows="10"></textarea>
                </fieldset>

                <fieldset class="containinfo ruleinfo">
                    <legend>Rules</legend>
                    <div class="label">Rules of Event:</div>
                    <textarea name="rule" id="rule" cols="30" rows="10"></textarea>
                </fieldset>
            </div>
        </div>
        <div class="btncontain">
            <input type="hidden" name="utype" value="">
            <input type="submit" class="btn" id="post" value='Post'>
        </div>
            
        </form>
        
        
        
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