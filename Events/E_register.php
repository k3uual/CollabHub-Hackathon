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

        .member {
            display: flex;
            
        }

        #mininp, #maxinp {
            width: 90%;
        }

        .max {
            margin-right: auto;
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
            <div class="menuopt"><i class="bi-person micon"></i><div class="opttxt" onclick="document.location.href = '<?php if($_COOKIE['usertype'] == 'students'){echo '../Students/S_edit.php';}else{echo '../Faculties/F_edit.php';}?>'">My Profile</div></div>

                <?php
                if(isset($_COOKIE['usertype'])){
                    if($_COOKIE['usertype'] == "faculties") {
                ?>
                <div class="menuopt"><i class="bi-calendar-check micon"></i><div class="opttxt" onclick="document.location.href = 'eventManage.php'">My Events</div></div>
                <?php
                    }
                    else {
                ?>
                <div class="menuopt"><i class="bi-people micon"></i><div class="opttxt" onclick="document.location.href = '../Collabs/collabManage.php'">My Collabs</div></div>
                <div class="menuopt"><i class="bi-person-add micon"></i><div class="opttxt" onclick="document.location.href = '../Students/selectTeam.php'">My Team</div></div>
                <div class="menuopt"><i class="bi-person-add micon"></i><div class="opttxt" onclick="document.location.href = '../Issues/issueManage.php'">My Issues</div></div>
                <?php
                    }
                }
                ?>
                <div class="menuopt lastopt" onclick="document.location.href = '../SignOut.php'"><i class="bi-box-arrow-right micon"></i><div class="opttxt">Sign Out</div></div>
            </div>
        </div>
        <form action="E_insert.php" method="post" enctype="multipart/form-data">
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
                    <div class="member">
                        <div class="min">
                            <div class="label">Mininmum no. of members:</div>
                            <input type="number" id="mininp" class="inp" name="min">
                        </div>
                        
                        <div class="max">
                            <div class="label">Maximum no. of members:</div>
                            <input type="number" id="maxinp" class="inp" name="max">
                        </div>
                    </div>
                    
                    
                    <div class="label">Organized By:</div>
                    <input type="text" class="inp" name="org">

                    <div class="label">Venue of Event:</div>
                    <div class="radios">
                        <label class="radele" for="online">
                            <input class="type" id="online" type="radio" name="venue" value="online" checked>Online
                        </label>
                        <label class="radele" for="offline">
                            <input class="type" id="offline" type="radio" name="venue" value="offline">Offline
                        </label>
                    </div>
                    
                    <div id="state" style="display: none;">
                        <div class="label">State:</div>
                        <input type="text" class="inp" name="state">
                    </div>
                    
                    <div id="city" style="display: none;">
                        <div class="label">City:</div>
                        <input type="text" class="inp" name="city">
                    </div>
                    
                    <div id="loc" style="display: none;">
                        <div class="label">Address:</div>
                        <input type="text" class="inp" name="loc">
                    </div>
                    
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
                    <input type="datetime-local" class="inp" name="regend">
        
                    <div class="label">Event Starts At:</div>
                    <input type="datetime-local" class="inp" name="eventstart">
        
                    <div class="label">Event Ends At:</div>
                    <input type="datetime-local" class="inp" name="eventend">
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

        const online = document.getElementById('online');
        const offline = document.getElementById('offline');
        const city = document.getElementById('city');
        const state = document.getElementById('state');
        const loc = document.getElementById('loc');


        online.addEventListener('change', function() {
            if (online.checked) {
                city.style.display = 'none';
                city.removeAttribute('required','');
                state.style.display = 'none';
                state.removeAttribute('required','');
                loc.style.display = 'none';
                loc.removeAttribute('required','');
                city.value = "";
                state.value = "";
                loc.value = "";
            }
        });
    
        offline.addEventListener('change', function() {
            if (offline.checked) {
                city.style.display = 'block';
                city.setAttribute('required','');
                state.style.display = 'block';
                state.setAttribute('required','');
                loc.style.display = 'block';
                loc.setAttribute('required','');
            }
        });
        
    </script>
</html>