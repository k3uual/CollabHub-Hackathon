<html>
    <head>
        <title>Login</title>
    </head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="form.css">

    <style>
        #signup {
            color: #666666;
            margin: -15px 0 15px 0;
        }

        .end {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .radios {
            margin: 5px 0;
        }

        .radios>label {
            padding: 2px 0 0 0;
        }

        a {
            color: rgb(55 112 255);
        }

        a:hover {
            color: rgb(28, 71, 179);
        }

        #forget {
            font-size: 13px;
        }

        #btn {
            margin-left: 10px;
            width: 300px;
        }
    </style>

    <body>
        
        <div class="form">
            <h1 id="title">Sign In:</h1>
            <h4 id="signup">Don't have an account? <a href="SignUp.html">Sign Up</a></h4>
            <form action="SignIn_auth.php" method="post">
                <input class="inp" type="text" placeholder="User ID" name="uid" required>

                <div class="passcontain">
                    <input class="inp" type="password" placeholder="Password" id="typepass" name="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    <div id="hidepass" onclick="togglePass()"><i id="eye" class="bi-eye-slash"></i></div>
                </div>

                <div class="radios">
                    <label class="radele" for="student">
                        <input class="type" id="student" type="radio" name="utype" value="students" checked>Student
                    </label>
                    <label class="radele" for="faculty">
                        <input class="type" id="faculty" type="radio" name="utype" value="faculties">Faculty
                    </label>
                    <label class="radele" for="Admin">
                        <input class="type" id="Admin" type="radio" name="utype" value="admin">Admin
                    </label>
                </div>
                <div class="end">
                    <input class="inp" id="btn" type="submit" value="Sign in">
                    
                </div>
                
            </form>
        </div>
        
    </body>
    <script>
        <?php
            if(isset($_GET['status'])) {
        ?>
            alert("Incorrect Password or UserID");
        <?php }?>
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