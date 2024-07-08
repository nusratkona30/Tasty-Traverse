<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="userlog.css">
    <script>
        function validateForm() {
            var username = document.forms["signupForm"]["usr"].value;
            var password = document.forms["signupForm"]["pass"].value;
            if (username == "" || password == "") {
                alert("Both fields must be filled out");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <h2>Sign Up</h2>
    <form name="signupForm" action="signup_handle.php" method="post" onsubmit="return validateForm()">
        <input type="text" placeholder="Username" name="usr" class="lname"><br>
        <input type="password" placeholder="Password" name="pass" class="lpas"><br>
        <input type="submit" value="Sign up" class="lbtn">
    </form>
</body>
</html>
