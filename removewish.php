<?php
session_start(); // Start session

require 'server.php';

    if (isset($_POST['remove_from_wishlist'])) {
    $user_id = $_SESSION['user_id'];
    $food_id = $_POST['food_id'];
$delete_query = "DELETE FROM wishlist WHERE user_id = $user_id AND food_id = $food_id";
    if (mysqli_query($conn, $delete_query)) {
        echo "Food item removed from your wishlist successfully.";
        header("Location: wishlist.php"); 
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>