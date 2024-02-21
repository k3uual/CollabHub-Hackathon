<html>
    <head>
        <title>Register</title>
    </head>
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
    <body>
        <h1>Register:</h1>
        <form action="Login.html" method="post">
            <img src="..\blank-pfp.png" for="pfp" ></img>
            <input type="file" id="chngPic" accept="image/*">

            <label for="uid">User-ID:</label>
            <input type="text" name="uid">

            <label for="uname">Name: </label>
            <input type="text" name="uname" required>
            
            <label for="inst">Institute Name:</label>
            <input type="text" name="inst" required>

            <label for="branch">Branch Name:</label>
            <input type="text" name="branch" required>

            <label for="email">Email:</label>
            <input type="email" name="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$">

            <label for="mobno">Mobile No.:</label>
            <input type="number" name="mobno" required>

            <label for="pass">Password: </label>
            <input type="password" id="typepass" name="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
            <div id="hidepass" onclick="togglePass()">hide</div>

            <label for="post">Post:</label>
            <input type="text" name="post">

            <input type="img" src="" value="Register">
        </form>
    </body>

    <script>
        function togglePass() {
            let temp = document.getElementById("typepass");
            let hide = document.getElementById("hidepass");

            if (temp.type === "password") {
                temp.type = "text";
                hide.innerHTML = "show";
            }
            else {
                temp.type = "password";
                hide.innerHTML = "hide";
            }
        }
    </script>
</html>