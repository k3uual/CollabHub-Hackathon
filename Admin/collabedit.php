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

        #rule, #overview {
            height: 470px;
        }

        .introinfo, .ruleinfo {
            margin-bottom: 25px;
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
                    <div class="nav lnav" onclick="document.location.href = 'eventManage.php'">Events</div>
                    <div class="nav midnav" onclick="document.location.href = 'collabManage.php'">Collabs</div>
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
        <?php
            //include("connect.php");
            $id = $_GET['id'];
            //$id = 8001001;
            
            include('connect.php');
            $query = "Select * from `collabs` where id = $id";
            $cmd = mysqli_query($con,$query);
            $row = mysqli_fetch_array($cmd);
        ?>
        <form action="C_update.php" method="post" enctype="multipart/form-data">
        <div class="infosection" >
            <div class="leftinfo">
                <div class="pfpcontain">
                    <?php
                    if($row['pic'] != NULL){
                    ?>
                    <img id="pfp" src="../display_img.php?userid=<?php echo $id;?>&usertype=collabs" alt="pfp">
                    <?php 
                    }
                    else {
                    ?>
                    <img id="pfp" src="../blank-pfp.png" alt="pfp">
                    <?php }?>
                    <div class="bi bi-pencil-fill" id="chngpic" onclick="openfile()"></div>
                    <input type="file" id="openimg" accept="image/*" name="uimg" onchange="loadFile(event)">
                </div>

                <fieldset class="containinfo gnrinfo">
                    <legend>General</legend>

                    <div class="label">Name of Event:</div>
                    <input type="text" class="inp" name="ename" value="<?php echo $row['name'];?>">

                    <div class="label">Registration Cost:</div>
                    <input type="number" class="inp" name="regcost" value="<?php echo $row['reg_cost'];?>">
                    
                    <?php
                    $online = 0;
                    if($row['state'] == 'online'){
                        $online = 1;
                    }
                    ?>
                    <div class="label">Venue of Event:</div>
                    <div class="radios">
                        <label class="radele" for="online">
                            <input class="type" id="online" type="radio" name="venue" value="online" <?php if($online == 1){ ?>checked<?php } ?>>Online
                        </label>
                        <label class="radele" for="offline">
                            <input class="type" id="offline" type="radio" name="venue" value="offline" <?php if($online == 0){ ?>checked<?php } ?>>Offline
                        </label>
                    </div>
                    
                    <div id="state" <?php if($online == 1){ ?>style="display: none;"<?php } ?>>
                        <div class="label">State:</div>
                        <input type="text" class="inp" name="state" value="<?php echo $row['state'];?>"<?php if($online == 0){?> required <?php }?>>
                    </div>
                    
                    <div id="city" <?php if($online == 1){ ?>style="display: none;"<?php } ?>>
                        <div class="label">City:</div>
                        <input type="text" class="inp" name="city" value="<?php echo $row['city'];?>"<?php if($online == 0){?> required <?php }?>>
                    </div>

                    <div id="loc" <?php if($online == 1){ ?>style="display: none;"<?php } ?>>
                        <div class="label">Address:</div>
                        <input type="text" class="inp" name="loc" value="<?php echo $row['loc'];?>"<?php if($online == 0){?> required <?php }?>>
                    </div>
                    
                </fieldset>

                <fieldset class="containinfo dateinfo">
                    <legend>Dates</legend>
                    
                    <div class="label">Registration Starts At:</div>
                    <input type="datetime-local" class="inp" name="regstart" value="<?php echo $row['reg_start'];?>">
        
                    <div class="label">Registration Ends At:</div>
                    <input type="datetime-local" class="inp" name="regend" value="<?php echo $row['reg_end'];?>">
        
                    <div class="label">Event Starts At:</div>
                    <input type="datetime-local" class="inp" name="eventstart" value="<?php echo $row['start'];?>">
        
                    <div class="label">Event Ends At:</div>
                    <input type="datetime-local" class="inp" name="eventend" value="<?php echo $row['end'];?>">
                </fieldset>
            </div>
            <div class="rightinfo">
                

                <fieldset class="containinfo introinfo">
                    <legend>Overview</legend>
                    <div class="label">Overview of Event:</div>
                    <textarea name="overview" id="overview" cols="30" rows="10"><?php echo $row['desc'];?></textarea>
                </fieldset>

                <fieldset class="containinfo ruleinfo">
                    <legend>Rules</legend>
                    <div class="label">Rules of Event:</div>
                    <textarea name="rule" id="rule" cols="30" rows="10"><?php echo $row['rules'];?></textarea>
                </fieldset>
            </div>
        </div>
        <div class="btncontain">
            <input type="hidden" name="id" value="<?php echo $row['id'];?>">
            <input type="submit" class="btn" id="edit" value='Edit Event'>
        </form>
    
            <form action="../delete.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                <input type="hidden" name="table" value="collabs">
                <input type="submit" class="btn" id="delete" value="Delete Event">
            </form>
        </div>
        
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