<?php
require 'server.php';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add') {
    // Retrieve form data
    $name = $_POST['name'];
    $price = $_POST['price'];
    $food_type = $_POST['food_type'];
    $img = $_FILES['img'];

    // Handle file upload
    $target_dir = "pimg/";
    $target_file = $target_dir . basename($img["name"]);

    // Move uploaded file to the target directory
    if (move_uploaded_file($img["tmp_name"], $target_file)) {
        // Insert food item into database
        $sql = "INSERT INTO food_items (name, price, food_type, img) VALUES ('$name', '$price', '$food_type', '$target_file')";
        if (mysqli_query($conn, $sql)) {
            echo "New food item added successfully.";
            header("Location: dashboard.php"); // Redirect back to the dashboard
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
