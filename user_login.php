<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="userlog.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <h1><i class="fa-regular fa-user"></i></h1>
    <h2>User Login </h2>
    <form action="login_handle_user.php" method="post" class="login-form">
        <input type="text" placeholder="Username" name="usr" class="lname"><br>
        <input type="password" placeholder="Password" name="pass" class="lpas"><br>
        <input type="submit" value="Log in" class="lbtn">
    </form>
</body>
</html>