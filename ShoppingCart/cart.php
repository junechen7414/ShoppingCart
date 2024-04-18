<?php include 'connect.php';

// update query
if(isset($_POST['update_product_quantity'])){
    $update_value = $_POST['update_quantity'];
    // echo $update_value;
    $update_id = $_POST['update_quantity_id'];
    // echo $update_id;
    
    // query
    // where condition is required or all quantity will update 
    $update_quantity_query=mysqli_query($conn,"Update `cart` set quantity=$update_value where id=$update_id");
    // echo "UPdate success"
    if($update_quantity_query){
        header('location:cart.php');
    }
}

// have to be same as set after cart.php?
if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    // echo $remove_id;
    // it's common sense that delete has to have a where
    mysqli_query($conn,"Delete from `cart` where id=$remove_id");
    // header('location:cart.php');
}

if(isset($_GET['delete_all'])){
    $remove_id = $_GET['delete_all'];
    // echo $remove_id;
    // it's common sense that delete has to have a where
    mysqli_query($conn,"Delete from `cart`");
    // header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <!-- css file -->
    <link rel ="stylesheet" href = "CSS/style.css">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- include header -->
    <?php include 'header.php' ?>
    <div class="container">
        <section class="shopping_cart">
            <h1 class="heading">My cart</h1>
            <table>
                <?php
                $grand_total=0;
                $select_cart_products=mysqli_query($conn,"Select * from `cart`");
                if(mysqli_num_rows($select_cart_products)>0){
                    echo "<thead>
                    <th>Sl No</th>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Product Price</th>
                    <th>Product Quantity</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </thead>";
                $num =1;
                while($fetch_cart_products=mysqli_fetch_assoc($select_cart_products)){
                    ?>
<tr>
                        <td><?php echo $num ?></td>
                        <td><?php echo $fetch_cart_products['name'] ?></td>
                        <td>
                            <img src="images/<?php echo $fetch_cart_products['image'] ?>" alt="">
                        </td>
                        <td>$<?php echo $fetch_cart_products['price'] ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart_products['id'] ?>">
                            <div class="quantity_box">
                                <input type="number" min="1" value="<?php echo $fetch_cart_products['quantity'] ?>" name="update_quantity">                                
                                <input type="submit" class="update_quantity" value="更新" name="update_product_quantity">
                            </div>
                            </form>
                        </td>
                        <td>$<?php echo $local_total=($fetch_cart_products['price']*$fetch_cart_products['quantity']) ?></td>
                        <td>
                            <a href="cart.php?remove=<?php echo $fetch_cart_products['id'] ?>" 
                            onclick="return confirm('Are you sure you want to delete this product')">
                                <i class="fas fa-trash"></i>
                                移除
                            </a>
                        </td>
                    </tr>
                    <?php
                $num++;
                $grand_total+=$local_total;
            }
                }else{       
                        echo "<div class='empty_text'>Cart is empty</div>";
                }
                ?>
                
                <tbody>
                    
                </tbody>
            </table>
            <!-- bottom area -->
            <div class="table_bottom">
                <a href="shop_products.php" class="bottom_btn">繼續購物</a>
                <h3 class="bottom_btn">總金額:$<span><?php echo $grand_total ?></span></h3>                
            </div>
            <a href="cart.php?delete_all" class="delete_all_btn" onclick="return confirm('Are you sure you want to delete this product')">
                <i class="fas fa-trash">全部移除</i>
            </a>
        </section>
    </div>
</body>
</html>