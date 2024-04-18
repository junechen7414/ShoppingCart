<?php include 'connect.php';
if(isset($_POST['add_to_cart'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;
    // select in cart
    $select_cart = mysqli_query($conn,"Select * from `cart` where name ='$product_name'");
    if(mysqli_num_rows($select_cart)>0){
        // already same name product
        $display_message[] = "Product already added to cart";
    }else{

    // insert data in cart table
    $insert_products = mysqli_query($conn,"insert into `cart` (name,price,image,quantity) values('$product_name','$product_price','$product_image',$product_quantity)");
    $display_message[] = "Product added to cart";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Products</title>

    <!-- css file -->
    <link rel ="stylesheet" href = "CSS/style.css">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- header -->
    <?php include'header.php';?>
    
    
    <div class="container">
    <?php
    if(isset($display_message)){
        foreach($display_message as $display_message){

     
        echo "<div class='display_message'>
        <span>$display_message</span>
        <i class='fas fa-times' onclick='this.parentElement.style.display=`none`';></i>
    </div>";
    }
    }
    ?>
        <section class="products">
            <h1 class="heading">Lets shop</h1>
            <div class="product_container">
                <?php
                $select_query = mysqli_query($conn,"Select * from `products`")or die("Failed to select * from products table");
                if(mysqli_num_rows($select_query)>0){
                    while($fetch_product = mysqli_fetch_assoc($select_query)){
                        ?>
                    <form method="post" action="">
                        <div class="edit_form">
                        <img src="images/<?php echo $fetch_product['image'] ?>" alt="">
                        <h3><?php echo $fetch_product['name'] ?></h3>
                        <div class="price"><?php echo $fetch_product['price'] ?></div>
                        <input type="hidden" name = "product_name" value = "<?php echo $fetch_product['name']?>">
                        <input type="hidden" name = "product_price" value="<?php echo $fetch_product['price']?>">
                        <input type="hidden" name = "product_image" value="<?php echo $fetch_product['image']?>">
                        <input type="submit" class="submit_btn cart_btn" value="加入購物車" name = "add_to_cart">
                    </div>
                </form>
                <?php
                    }
                    
                }else{
                    echo "<div class='empty_text'>No Products Available</div>";
                }
                ?>
                
            </div>
        </section>
    </div>
</body>
</html>