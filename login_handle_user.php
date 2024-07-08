<?php
    session_start();
    include_once 'server.php';

    $username = $_POST['usr'];
    $password = $_POST['pass'];

    $sql = "SELECT * FROM `loginfo` WHERE `user_name`='$username' AND `pass`='$password' AND `user_type`=1;";
    $receive = mysqli_query($conn,$sql);

    if(mysqli_num_rows($receive) > 0){
        $user = mysqli_fetch_assoc($receive);

        $_SESSION['user_id'] = $user['id']; 
        $_SESSION['username'] = $user['user_name'];
        $_SESSION['user_type'] = $user['user_type'];
        header("Location:http://localhost/project/home.php");
        exit();
    }
    else{
        die("INVALID PASS OR USERNAME");
    }
   
?>