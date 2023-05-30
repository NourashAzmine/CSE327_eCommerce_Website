<?php
include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}

$message = [];

if (isset($_POST['update_order'])) {
   $order_update_id = $_POST['order_id'];

   // Check if the 'update_payment' value is set
   if (isset($_POST['update_payment'])) {
      $update_payment = $_POST['update_payment'];
      mysqli_query($conn, "UPDATE `orders` SET delivery_status = '$update_payment' WHERE id = '$order_update_id'") or die('Query failed');
      $message[] = 'Payment status has been updated!';
   }

   // Check if the 'estimated_delivery_date' value is set
   if (isset($_POST['estimated_delivery_date'])) {
      $estimated_delivery_date = $_POST['estimated_delivery_date'];
      mysqli_query($conn, "UPDATE `orders` SET estimated_delivery_date = '$estimated_delivery_date' WHERE id = '$order_update_id'") or die('Query failed');
      $message[] = 'Estimated delivery date has been updated!';
   } else {
      $estimated_delivery_date = ""; // Set to blank if not set
   }

   // Check if the 'estimated_delivery_time' value is set
   if (isset($_POST['estimated_delivery_time'])) {
      $estimated_delivery_time = $_POST['estimated_delivery_time'];
      mysqli_query($conn, "UPDATE `orders` SET estimated_delivery_time = '$estimated_delivery_time' WHERE id = '$order_update_id'") or die('Query failed');
      $message[] = 'Estimated delivery time has been updated!';
   } else {
      $estimated_delivery_time = ""; // Set to blank if not set
   }
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('Query failed');
   header('location:admin_orders.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
   <?php include 'admin_header.php'; ?>

   <section class="orders">
      <h1 class="title">Placed Orders</h1>

      <div class="box-container">
         <?php
         $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('Query failed');
         if (mysqli_num_rows($select_orders) > 0) {
            while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
               //estimated delivery date to dd/mm/year format or set to blank if not set
               $estimated_delivery_date = $fetch_orders['estimated_delivery_date'] ? date('d/m/Y', strtotime($fetch_orders['estimated_delivery_date'])) : "";
               //estimated delivery time to 24-hour format or set to blank if not set
               $estimated_delivery_time = $fetch_orders['estimated_delivery_time'] ? date('H:i', strtotime($fetch_orders['estimated_delivery_time'])) : "";
         ?>
         <div class="box">
            <p> User id : <span><?php echo $fetch_orders['user_id']; ?></span> </p>
            <p> Order_ID : <span><?php echo $fetch_orders['id']; ?></span> </p>
            <p> Placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
            <p> Name : <span><?php echo $fetch_orders['name']; ?></span> </p>
            <p> Number : <span><?php echo $fetch_orders['number']; ?></span> </p>
            <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
            <p> Address : <span><?php echo $fetch_orders['address']; ?></span> </p>
            <p> Total products : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
            <p> Total price : <span>৳<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
            <p> Payment method : <span><?php echo $fetch_orders['method']; ?></span> </p>
            <form action="" method="post">
               <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
               <p> Estimated Delivery Date: 
                  <span><?php echo $estimated_delivery_date; ?></span>
               </p>
               <input type="date" name="estimated_delivery_date" placeholder="Est. Delivery Date" value="<?php echo $fetch_orders['estimated_delivery_date']; ?>">
               <p> Estimated Delivery Time: 
                  <span><?php echo $estimated_delivery_time; ?></span>
               </p>
               <input type="time" name="estimated_delivery_time" placeholder="Est. Delivery Time" value="<?php echo $fetch_orders['estimated_delivery_time']; ?>">
               <select name="update_payment">
                  <option value="" selected disabled>
                     <?php echo $fetch_orders['delivery_status']; ?>
                  </option>
                  <option value="pending">pending</option>
                  <option value="confirmed">confirmed</option>
                  <option value="delivered">delivered</option>
               </select>
               <input type="submit" value="Update" name="update_order" class="option-btn">
               <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('Delete this order?');" class="delete-btn">Delete</a>
            </form>
         </div>
         <?php
            }
         } else {
            echo '<p class="empty">No orders placed yet!</p>';
         }
         ?>
      </div>
   </section>

   <!-- custom admin js file link  -->
   <script src="js/admin_script.js"></script>
</body>
</html>
