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
        <form action="" method="post">
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
            <input type="password" name="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
            
            <input type="radio" name="utype" value="student">Student
            <input type="radio" name="utype" value="faculty">Faculty

            <label for="sem">Semester:</label>
            <input type="number" name="sem">

            <label for="post">Post:</label>
            <input type="text" name="post">

            <input type="submit" value="Register">
        </form>
    </body>
</html>