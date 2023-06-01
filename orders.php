<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
   header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>

   <!-- font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Your Orders</h3>
   <p><a href="home.php">Home</a> / Orders</p>
</div>

<section class="placed-orders">

   <h1 class="title">Placed Orders</h1>

   <div class="box-container">

      <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('Query failed');
         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
      ?>
      <div class="box">
         <p> Order_ID : <span><?php echo $fetch_orders['id']; ?></span> </p>
         <p> Placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> Name : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> Number : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> Address : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> Payment method : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <p> Your orders : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> Total : <span>৳<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
         <p> Discount : <span>৳<?php echo $fetch_orders['total_price'] - $fetch_orders['discount_total_price'];?>/-</span> </p>
         <p> Subtotal : <span>৳<?php echo $fetch_orders['discount_total_price'];?>/-</span> </p>

         <?php if (isset($fetch_orders['estimated_delivery_date']) && isset($fetch_orders['estimated_delivery_time'])) { ?>
            <p> Estimated Delivery Date: <span><?php echo date('d/m/Y', strtotime($fetch_orders['estimated_delivery_date'])); ?></span> </p>
            <p> Estimated Delivery Time: <span><?php echo date('h:i A', strtotime($fetch_orders['estimated_delivery_time'])); ?></span> </p>
         <?php } else { ?>
            <p> Estimated Delivery Date: <span>Processing</span> </p>
            <p> Estimated Delivery Time: <span>Processing</span> </p>
         <?php } ?>
         <p> Delivery status : <span style="color:<?php if($fetch_orders['delivery_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $fetch_orders['delivery_status']; ?></span> </p>
         <div class="button-container">
            <div class="file-complaint-container">
               <a href="complaint.php?order_id=<?php echo $fetch_orders['id']; ?>&name=<?php echo $fetch_orders['name']; ?>&email=<?php echo $fetch_orders['email']; ?>&number=<?php echo $fetch_orders['number']; ?>" class="file-complaint">
                  <i class="fas fa-exclamation-circle"></i> File a Complaint
               </a>
               <?php if ($fetch_orders['delivery_status'] == 'delivered') { ?>
                  <a href="download_receipt.php?order_id=<?php echo $fetch_orders['id']; ?>" class="download-receipt">
                     <i class="fas fa-download"></i> Download Receipt
                  </a>
            <?php } ?>
            </div>
            
         </div>
      </div>
      <?php
       }
      }else{
         echo '<p class="empty">No orders placed yet!</p>';
      }
      ?>
   </div>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link -->
<script src="js/script.js"></script>

</body>
</html>
