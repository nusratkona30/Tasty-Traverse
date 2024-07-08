<!DOCTYPE html>
<html>

<head>
    <title>Menu</title>
    <link rel="stylesheet" href="mnu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="menu">
        <h1>Bakery Delicacies</h1>
    </div>
     
    
    <div class="container">
    <div class="cupcake">

    <?php
    session_start();
    require 'server.php';

    function isInWishlist($conn, $user_id, $food_id) {
        $query = "SELECT * FROM wishlist WHERE user_id = $user_id AND food_id = $food_id";
        $result = mysqli_query($conn, $query);
        return (mysqli_num_rows($result) > 0);
    }

    function isInCart($conn, $user_id, $food_id) {
        $query = "SELECT * FROM cart WHERE user_id = $user_id AND food_id = $food_id";
        $result = mysqli_query($conn, $query);
        return (mysqli_num_rows($result) > 0);
    }

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
                echo "<div class='hd1'>";
                echo "<h1>" . $currentType . "</h1>";
                echo "</div>";
                echo "<div class='card-container'>";
            }
            echo "<div class='card'>";
            echo "<img src='" . $row['img'] . "' alt='" . $row['name'] . "'>";
            echo "<div class='dam'>";
            echo "<p>" . $row['name'] . "</p>";
            echo "<p>Price: $" . $row['price'] . "</p>";
            echo "</div>";

            echo "<div class='icons'>";
            $isInWishlist = isInWishlist($conn, $_SESSION['user_id'], $row['id']);
        echo "<form action='wishlist_handle.php' method='post'>";
        echo "<input type='hidden' name='food_id' value='" . $row['id'] . "'>";
        if ($isInWishlist) {
            echo "<button type='submit' name='remove_from_wishlist'><i class='fa fa-heart'></i></button>";
        }
        else {
            echo "<button type='submit' name='add_to_wishlist'><i class='fa-regular fa-heart'></i></button>";
        }
        echo "</form>";

            $isInCart = isInCart($conn, $_SESSION['user_id'], $row['id']);
        
        echo "<form action='cart_handle.php' method='post'>";
        echo "<input type='hidden' name='food_id' value='" . $row['id'] . "'>";
        echo "<div class='quantity-select'>";
        echo "<label for='quantity-" . $row['id'] . "'>Quantity:</label>";
        echo "<input type='number' id='quantity-" . $row['id'] . "' name='quantity' min='1' value='1'>";
        echo "</div>";
        if ($isInCart) {
            echo "<button type='submit' name='update_cart'><i class='fas fa-shopping-cart'></i> Update Cart</button>";
        } else {
            echo "<button type='submit' name='add_to_cart'><i class='fas fa-shopping-cart'></i> Add to Cart</button>";
        }
        echo "</form>";

            echo "</div>"; 
            echo "</div>";
        }
        echo "</div>"; // Close the last food type section
    } else {
        echo "<p>No food items found</p>";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
        <!-- <div class="hd1"><h1>---Cupcakes---</h1></div>
        <div class="card">
            <img src="https://sallysbakingaddiction.com/wp-content/uploads/2017/06/moist-chocolate-cupcakes-5.jpg" alt="food">
            <div class="dam"><i class="fa fa-money"></i>Chocolate falavour - 100 tk</div>
            <a href="#" class="wishlist"><i class="fas fa-heart"></i></a>
            <a href="#" class="cart"><i class="fas fa-shopping-cart"></i></a>
        </div>

        <div class="card">
            <img src="https://chelsweets.com/wp-content/uploads/2017/07/IMG_9265-scaled.jpg.webp" alt="food">
            <div class="dam"><i class="fa fa-money"></i>Vanilla falavour - 80 tk</div>
            <a href="#" class="wishlist"><i class="fas fa-heart"></i></a>
            <a href="#" class="cart"><i class="fas fa-shopping-cart"></i></a>
        </div>

        <div class="card">
            <img src="https://pbs.twimg.com/media/FPp-wAVVkAMxMZw.jpg:large" alt="food">
            <div class="dam"><i class="fa fa-money"></i>Strawberry falavour - 80 tk</div>
            <a href="#" class="wishlist"><i class="fas fa-heart"></i></a>
            <a href="#" class="cart"><i class="fas fa-shopping-cart"></i></a>
        </div>

        <div class="card">
            <img src="https://healthylittlepeach.com/wp-content/uploads/2023/09/lemon-gluten-free-cupcakes-1-20.jpg" alt="food">
            <div class="dam"><i class="fa fa-money"></i>Lemon falavour - 80 tk</div>
            <a href="#" class="wishlist"><i class="fas fa-heart"></i></a>
            <a href="#" class="cart"><i class="fas fa-shopping-cart"></i></a>
        </div>
    <div class="hd1"><h1>---Birthday Cakes---</h1></div>

        <div class="card">
            <img src="https://i.pinimg.com/originals/f1/7d/37/f17d370a4c6d71fa21f7040408f4e2a0.png" alt="food">
            <div class="dam"><i class="fa fa-money"></i>Flower Customized - 1500 tk</div>
            <a href="#" class="wishlist"><i class="fas fa-heart"></i></a>
            <a href="#" class="cart"><i class="fas fa-shopping-cart"></i></a>
        </div>

        <div class="card">
            <img src="https://images.immediate.co.uk/production/volatile/sites/2/2023/09/Chocolate-celebration-cake-45c2b46.jpg" alt="food">
            <div class="dam"><i class="fa fa-money"></i>Butterscotch Cake - 2000 tk</div>
            <a href="#" class="wishlist"><i class="fas fa-heart"></i></a>
            <a href="#" class="cart"><i class="fas fa-shopping-cart"></i></a>
        </div>

        <div class="card">
            <img src="https://i.pinimg.com/originals/c1/5a/96/c15a96797b9c144aaeb5779a9d62f2dc.jpg" alt="food">
            <div class="dam"><i class="fa fa-money"></i>Chocolate Cake - 1800 tk</div>
            <a href="#" class="wishlist"><i class="fas fa-heart"></i></a>
            <a href="#" class="cart"><i class="fas fa-shopping-cart"></i></a>
        </div>

        <div class="card">
            <img src="https://i.pinimg.com/564x/52/fc/1b/52fc1bddb6a23325e976021208218da4.jpg" alt="food">
            <div class="dam"><i class="fa fa-money"></i>Vanilla falavour - 1800 tk</div>
            <a href="#" class="wishlist"><i class="fas fa-heart"></i></a>
            <a href="#" class="cart"><i class="fas fa-shopping-cart"></i></a>
        </div>
        
        <div class="card">
            <img src="https://mrscscupcakes.com.au/cdn/shop/products/black-forest-2.jpg?v=1583819667" alt="food">
            <div class="dam"><i class="fa fa-money"></i>Black forest - 2000 tk</div>
            <a href="#" class="wishlist"><i class="fas fa-heart"></i></a>
            <a href="#" class="cart"><i class="fas fa-shopping-cart"></i></a>
        </div> -->

    </div>
    </div>
</body>