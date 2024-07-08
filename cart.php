<?php
session_start(); 
 
require 'server.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit();
}
 
$user_id = $_SESSION['user_id'];
 

$sql = "SELECT food_items.*
        FROM cart
        INNER JOIN food_items ON cart.food_id = food_items.id
        WHERE cart.user_id = $user_id";
$result = mysqli_query($conn, $sql);
 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
</head>
<body>
    <h2>Cart</h2>
    <a href="home.php" class="hp"><i class="fas fa-arrow-left"></i></a>
    <div class="cart">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="cart-item">
                    <img src="<?php echo $row['img']; ?>" alt="<?php echo $row['name']; ?>">
                    <h3><?php echo $row['name']; ?></h3>
                    <p>Price: $<?php echo $row['price']; ?></p>
                    <div class="icons">
                        <form action="removecart.php" method="post">
                            <input type="hidden" name="food_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="remove_from_cart" class="btn"><i class="fas fa-shopping-cart"></i> Remove from Cart</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>
</body>
</html>
 
<?php
mysqli_close($conn);
?>
