<?php
session_start(); // Start session
 
require 'server.php';
 
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect if not logged in
    exit();
}
 
$user_id = $_SESSION['user_id'];
 
if (isset($_POST['add_to_cart'])) {
    $food_id = $_POST['food_id'];
    $quantity = $_POST['quantity'];
 
    // Insert into cart table
    $insert_query = "INSERT INTO cart (user_id, food_id, quantity) VALUES ($user_id, $food_id, $quantity)";
    if (mysqli_query($conn, $insert_query)) {
        echo "Item added to cart.";
        header("Location: menu.php"); 
        exit();
    } else {
        echo "Error adding item to cart: " . mysqli_error($conn);
    }
} elseif (isset($_POST['update_cart'])) {
    $food_id = $_POST['food_id'];
    $quantity = $_POST['quantity'];
 
    // Update cart table
    $update_query = "UPDATE cart SET quantity = $quantity WHERE user_id = $user_id AND food_id = $food_id";
    if (mysqli_query($conn, $update_query)) {
        echo "Cart updated.";
        header("Location: menu.php"); 
        exit();
    } else {
        echo "Error updating cart: " . mysqli_error($conn);
    }
}
 
mysqli_close($conn);
?>