<?php

include 'config.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
}

if (isset($_POST['add_to_cart'])) {
   // Check if the user is logged in
   if ($user_id != '') {
      $product_name = $_POST['product_name'];
      $product_price = $_POST['product_price'];
      $discount_product_price = $_POST['discount_product_price'];
      $product_image = $_POST['product_image'];
      $product_quantity = $_POST['product_quantity'];

      $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

      if (mysqli_num_rows($check_cart_numbers) > 0) {
         $message[] = 'already added to cart!';
      } else {
         mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price,discount_price, quantity, image) VALUES('$user_id', '$product_name', '$product_price','$discount_product_price', '$product_quantity', '$product_image')") or die('query failed');
         $message[] = 'product added to cart!';
      }
   } else {
      // Redirect the user to the login page
      header("Location: login.php");
      exit();
   }
}

if (isset($_POST['request_product'])) {
   $product_name = $_POST['product_name'];
   // Check if the user is logged in
   if ($user_id != '') {
      $check_request = mysqli_query($conn, "SELECT * FROM `request` WHERE `user_id` = '$user_id' AND `name` = '$product_name'") or die('Query failed');
      if (mysqli_num_rows($check_request) > 0) {
         $message[] = 'Product already requested!';
      } else {
         mysqli_query($conn, "INSERT INTO `request` (user_id, name) VALUES ('$user_id', '$product_name')") or die('Query failed');
         $message[] = 'Product requested successfully!';
      }
   } else {
      // Redirect the user to the login page
      header("Location: login.php");
      exit();
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>our shop</h3>
   <p> <a href="home.php">home</a> / shop </p>
</div>

<section class="products">

   <h1 class="title">latest products</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)) {
               $is_product_available = $fetch_products['available'];
               $product_name = $fetch_products['name'];
               $check_request = mysqli_query($conn, "SELECT * FROM `request` WHERE `user_id` = '$user_id' AND `name` = '$product_name'") or die('Query failed');
               $is_requested = mysqli_num_rows($check_request) > 0;
         ?>
               <form action="" method="post" class="box">
                  <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                  <div class="name"><?php echo $fetch_products['name']; ?></div>
                  <div class="price">
                     <?php if ($fetch_products['discount_price'] != $fetch_products['price']) { ?>
                        <span class="discounted-price">৳<?php echo $fetch_products['discount_price']; ?></span>
                        <span class="original-price">৳<?php echo $fetch_products['price']; ?>/-</span>
                     <?php } else { ?>
                        <span class="discounted-price">৳<?php echo $fetch_products['discount_price']; ?>/-</span>
                     <?php } ?>
                  </div>
                  <?php if ($is_product_available == 1) {
                     ?>
                        <input type="number" min="1" name="product_quantity" value="1" class="qty">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                        <input type="hidden" name="discount_product_price" value="<?php echo $fetch_products['discount_price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                        <input type="submit" value="Add to Cart" name="add_to_cart" class="btn">
                     <?php 
                  } else { ?>
                     <br><br><br><br><br><br>
                     <button type="submit" name="request_product" class="delete-btn out-of-stock">Out of Stock</button>
                     <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                  <?php } ?>
               </form>
         <?php
            }
         } else {
            echo '<p class="empty">No products added yet!</p>';
         }
      ?>
   </div>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
