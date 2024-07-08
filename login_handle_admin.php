<?php
    include_once 'server.php';

    $username = $_POST['usr'];
    $password = $_POST['pass'];

    $sql = "SELECT * FROM `loginfo` WHERE `user_name`='$username' AND `pass`='$password' AND `user_type`=0;";
    $receive = mysqli_query($conn,$sql);

    if(mysqli_num_rows($receive) > 0){
        header("Location:http://localhost/project/dashboard.php");
    }
    else{
        die("INVALID PASS OR USERNAME");
    }
   
?>