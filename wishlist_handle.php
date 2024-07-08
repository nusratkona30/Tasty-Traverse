<?php
session_start(); // Start session

require 'server.php';

if (isset($_POST['add_to_wishlist'])) {
    $user_id = $_SESSION['user_id'];
    $food_id = $_POST['food_id'];

    // Check if the item is already in the wishlist
    $check_query = "SELECT * FROM wishlist WHERE user_id = $user_id AND food_id = $food_id";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "Food item is already in your wishlist.";
        header("Location: menu.php"); 
        exit();
    }
else {
        // Insert into wishlist
        $insert_query = "INSERT INTO wishlist (user_id, food_id) VALUES ($user_id, $food_id)";
        if (mysqli_query($conn, $insert_query)) {
            echo "Food item added to your wishlist successfully.";
            header("Location: menu.php"); 
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
} elseif (isset($_POST['remove_from_wishlist'])) {
    $user_id = $_SESSION['user_id'];
    $food_id = $_POST['food_id'];
$delete_query = "DELETE FROM wishlist WHERE user_id = $user_id AND food_id = $food_id";
    if (mysqli_query($conn, $delete_query)) {
        echo "Food item removed from your wishlist successfully.";
        header("Location: menu.php"); 
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>