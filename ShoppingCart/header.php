<?php
?>
<header class="header">
        <div class = "header_body">
            <a href = "index.php" class = "logo">MainPage</a>
            <nav class ="navbar">
                <a href="index.php">Add Products</a>
                <a href="view_product.php">View Products</a>
                <a href="shop_products.php">Shopping</a>
            </nav>
            <!-- select query -->
            <?php
            // 不用在include connect.php是因為其他php file有同時include過connect和header了
            $select_query = mysqli_query($conn,"Select * from `cart`")or die('select query failed');
            $row_count = mysqli_num_rows($select_query);
            ?>

            <a href="cart.php" class="cart"><i class="fa-solid fa-cart-shopping"></i><span><sup><?php echo $row_count ?></sup></span></a>
            <!-- <div id="menu-btn" class="fas fa-bars"></div> -->
        </div>

    </header>