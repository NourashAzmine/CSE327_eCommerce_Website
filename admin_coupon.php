<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

error_reporting(E_ALL);

if (!isset($admin_id)) {
    header('location:login.php');
}

// Delete coupon
if (isset($_GET['delete_coupon'])) {
    $couponId = $_GET['delete_coupon'];

    $deleteQuery = "DELETE FROM `coupons` WHERE id = '$couponId'";

    if (mysqli_query($conn, $deleteQuery)) {
        $message = 'Coupon deleted successfully!';
    } else {
        $message = 'Coupon could not be deleted!';
    }
}

if (isset($_POST['add_coupon'])) {
    $code = mysqli_real_escape_string($conn, $_POST['code']);
    $discount = $_POST['discount'];

    $insert_query = "INSERT INTO `coupons` (code, discount) VALUES ('$code', '$discount')";

    if (mysqli_query($conn, $insert_query)) {
        $message = 'Coupon added successfully!';
    } else {
        $message = 'Coupon could not be added!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Coupon</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<!-- product CRUD section starts  -->

<section class="add-products">

   <h1 class="title">Coupon</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <h3>Add Coupon</h3>
      <input type="text" name="code" class="box" placeholder="enter coupon code" required>
      <input type="number" min="0" name="discount" class="box" placeholder="enter coupon discount" required>
      <input type="submit" value="add coupon" name="add_coupon" class="btn">
   </form>

</section>


<!-- product CRUD section ends -->

<!-- show products  -->

<section class="show-products">

   <div class="box-container">

      <?php
         $select_coupons = mysqli_query($conn, "SELECT * FROM `coupons`") or die('Query failed');
         if(mysqli_num_rows($select_coupons) > 0){
            while($fetch_coupons = mysqli_fetch_assoc($select_coupons)){
      ?>
      <div class="box">
         <div class="name"><?php echo $fetch_coupons['code']; ?></div>
         <div class="price"><?php echo $fetch_coupons['discount']; ?>%</div>
         <a href="?delete_coupon=<?php echo $fetch_coupons['id']; ?>" class="delete-btn">delete</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">No coupons added yet!</p>';
      }
      ?>
   </div>

</section>




<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>
