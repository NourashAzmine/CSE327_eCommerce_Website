<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['update_cart'])){
   $cart_id = $_POST['cart_id'];
   $cart_quantity = $_POST['cart_quantity'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
   $message[] = 'cart quantity updated!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
   header('location:cart.php');
}

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:cart.php');
}
$discount_percentage = 0;
$discounted_total = 0;

// Apply coupon code
if(isset($_POST['apply_coupon'])){
   $coupon_code = $_POST['coupon_code'];

   $coupon_query = mysqli_query($conn, "SELECT * FROM `coupons` WHERE code = '$coupon_code'") or die('Query failed');

   if(mysqli_num_rows($coupon_query) > 0){
      $coupon = mysqli_fetch_assoc($coupon_query);
      $discount_percentage = $coupon['discount'];

      // Calculate discount based on percentage
      

      $message[] = "Coupon applied successfully! ";
   } else {
      $message[] = "Invalid coupon code!";
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>shopping cart</h3>
   <p> <a href="home.php">home</a> / cart </p>
</div>

<section class="shopping-cart">

   <h1 class="title">products added</h1>

   <div class="box-container">
      <?php
         $grand_total = 0;
         $discount_grand_total = 0;
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){   
      ?>
      <div class="box">
         <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from cart?');"></a>
         <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_cart['name']; ?></div>
         <div class="price">$<?php echo $fetch_cart['price']; ?>/-</div>
         <form action="" method="post">
            <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
            <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
            <input type="submit" name="update_cart" value="update" class="option-btn">
         </form>
         <div class="sub-total"> sub total : <span>$<?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']); ?>/-</span> </div>
         <div class="sub-total"> Discount sub total : <span>$<?php echo $discount_sub_total = ($fetch_cart['quantity'] * $fetch_cart['discount_price']); ?>/-</span> </div>
      </div>
      <?php
      $grand_total += $sub_total;
      $discount_grand_total += $discount_sub_total;
      $discount_amount = $discount_grand_total * ($discount_percentage / 100);
      $discounted_total = $discount_grand_total - $discount_amount;
         }
      }else{
         echo '<p class="empty">your cart is empty</p>';
      }
      ?>
   </div>

   <div style="margin-top: 2rem; text-align:center;">
      <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('delete all from cart?');">delete all</a>
   </div>

   <div class="cart-total">
      <p>grand total : <span>$<?php echo $grand_total; ?>/-</span></p>
      <p>Discount grand total : <span>$<?php echo $discounted_total; ?>/-</span></p>
      <form action="" method="post">
            <input type="text" min="1" name="coupon_code" value="<?php  ?>">
            <input type="submit" name="apply_coupon" value="apply" class="option-btn">
      </form>
      <?php
         if(isset($message)){
            foreach($message as $msg){
               echo "<p>$msg</p>";
            }
         }
      ?>
      <div class="flex">
         <a href="shop.php" class="option-btn">continue shopping</a>
         <a href="checkout.php?total=<?php echo $discounted_total; ?>" class="btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">proceed to checkout</a>
      </div>
   </div>

</section>


<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>