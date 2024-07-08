<?php
session_start(); // Start session

require 'server.php';

    if (isset($_POST['remove'])) {
        $food_id = $_POST['food_id'];
        $delete_query = "DELETE FROM food_items WHERE id = $food_id";
    if (mysqli_query($conn, $delete_query)) {
        echo "Food item removed successfully.";
        header("Location: dashboard.php"); 
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
