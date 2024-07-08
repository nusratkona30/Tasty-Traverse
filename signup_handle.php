<?php
require 'server.php';

$user = $_POST['usr'];
$pass = $_POST['pass'];
$user_type = 1; 


$sql = "INSERT INTO loginfo (user_name, pass, user_type) VALUES ('$user', '$pass', '$user_type')";


if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
    header("Location: http://localhost/project/user_login.php");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>