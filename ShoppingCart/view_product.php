<!-- include connecting to database -->
<?php include 'connect.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <!-- css file -->
    <link rel="stylesheet" href="CSS/style.css">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
<body>
    <!-- header -->
    <?php include 'header.php'    ?>

    <!-- container -->
    <div class="container">
        <section class="display_products">
            
                    <!-- php to get data from database system -->
                    <?php
                        $display_product = mysqli_query($conn, "Select * from `products`");
                        $num = 1;
                        if(mysqli_num_rows($display_product)>0){
                            echo "<table>
                            <thead>
                                <th>Sl No</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Action</th>
                            </thead>
                            <tbody>";

                            // to fetch data
                            while($row = mysqli_fetch_assoc($display_product)){
                                                                
                                ?>
                                
<!-- display table -->

<tr>
                        <td><?php echo $num?></td>
                        <td><img src="images/<?php echo $row['image']?>" alt="<?php echo $row['name']?>"></td>
                        <td><?php echo $row['name']
                        // 要和資料表一樣
                         ?></td>
                        <td><?php echo $row['price']?></td>
                        <td>
                            <a href="delete.php?delete=<?php echo $row['id']?>" 
                            class = "delete_product_btn" onclick = "return confirm('Are you sure you want to delete this product');">
                            <i class="fas fa-trash"></i></a>
                            <a href="edit.php?edit=<?php echo $row['id']?>" 
                            class = "update_product_btn"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>

                                <?php
                                $num++;

                            }                            
                        }else{
                            echo "<div class='empty_text'>No Products Available</div>";
                        }
                    ?>
                    
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>