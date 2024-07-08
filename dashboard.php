<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <h2>Admin Dashboard</h2>
    <a href="index.php">Logout</a>
    <h3>Add Food Item</h3>
    <form method="POST" action="itemcreate_handle.php" enctype="multipart/form-data">
        <input type="hidden" name="action" value="add">
        Name: <input type="text" name="name" required><br>
        Price: <input type="text" name="price" required><br>
        Item Type: 
        <select name="food_type" required>
            <option value="" disabled selected>Select Item Type</option>
            <option value="Cupcake">Cupcake</option>
            <option value="Birthday cake">Birthday Cake</option>
            <option value="Cookies">Cookies</option>
            <option value="Customized cake">Customised Cake</option>
        </select><br>
        Image: <input type="file" name="img" required><br>
        <input type="submit" value="Add Food Item">
    </form>

    <?php
    require 'server.php';

    $sql = "SELECT * FROM food_items ORDER BY food_type DESC";
    $result = mysqli_query($conn, $sql);

    $currentType = '';
    $hasItems = false;

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            if ($row['food_type'] != $currentType) {
                if ($hasItems) {
                    echo "</div>"; // Close previous food type section
                }
                $currentType = $row['food_type'];
                $hasItems = true;
                echo "<div class='food-type-section'>";
                echo "<h3>" . $currentType . "</h3>";
                echo "<div class='card-container'>";
            }
            echo "<div class='card'>";
            echo "<img src='" . $row['img'] . "' alt='" . $row['name'] . "'>";
            echo "<h4>" . $row['name'] . "</h4>";
            echo "<p>Price: $" . $row['price'] . "</p>";
            echo "<p>Type: " . $row['food_type'] . "</p>";
            echo "<form method='POST' action='admindelete_handle.php' class='delete-form'>";
            echo "<input type='hidden' name='food_id' value='" . $row['id'] . "'>";
            echo "<input type='submit' name='remove' value='Delete'>";
            echo "</form>";
            echo "</div>";
        }

        echo "</div>"; 
    } else {
        echo "<p>No food items found</p>";
    }

    
    mysqli_close($conn);
    ?>
</body>
</html>
