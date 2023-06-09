<?php
include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $complaint = mysqli_query($conn, "SELECT * FROM `complaints` WHERE complaint_id = '$delete_id'") or die('Query failed');
   $complaintData = mysqli_fetch_assoc($complaint);
   
   // Delete the uploaded photo
   $filePath = $complaintData['photo'];
   if(!empty($filePath)){
      unlink($filePath);
   }
   
   // Delete the webcam captured file
   $webcamPath = 'webcam_img/' . basename($complaintData['webcam_photo']);
   if (!empty($complaintData['webcam_photo']) && file_exists($webcamPath)) {
      unlink($webcamPath);
   }
   
   mysqli_query($conn, "DELETE FROM `complaints` WHERE complaint_id = '$delete_id'") or die('Query failed');
   header('location:admin_complaints.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Complaints</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="messages">

   <h1 class="title">Complaints</h1>

   <div class="box-container">
   <?php
      $select_complaint = mysqli_query($conn, "SELECT * FROM `complaints`") or die('Query failed');
      if(mysqli_num_rows($select_complaint) > 0){
         while($fetch_complaint = mysqli_fetch_assoc($select_complaint)){
      
   ?>
   <div class="box">
      <p>Complaint ID: <span><?php echo $fetch_complaint['complaint_id']; ?></span></p>
      <p>User ID: <span><?php echo $fetch_complaint['user_id']; ?></span></p>
      <p>Name: <span><?php echo $fetch_complaint['name']; ?></span></p>
      <p>Number: <span><?php echo $fetch_complaint['number']; ?></span></p>
      <p>Email: <span><?php echo $fetch_complaint['email']; ?></span></p>
      <p>Order ID: <span><?php echo $fetch_complaint['order_id']; ?></span></p>
      <p>Description: <span><?php echo $fetch_complaint['message']; ?></span></p>
      <?php if(!empty($fetch_complaint['photo'])): ?>
         <?php
         $photoPath = 'uploaded_img/' . basename($fetch_complaint['photo']);
         if (file_exists($photoPath)) {
            echo '<img src="' . $photoPath . '" alt="Complaint Photo" class="complaint-photo">';
         } else {
            echo '<p class="empty">Photo not found!</p>';
         }
         ?>
      <?php endif; ?>
      <div class="center-btn">
         <a href="admin_complaints.php?delete=<?php echo $fetch_complaint['complaint_id']; ?>" onclick="return confirm('Delete this complaint?');" class="delete-btn">Delete Complaint</a>
      </div>
   </div>
   <?php
      }
   } else {
      echo '<p class="empty">You have no complaints!</p>';
   }
   ?>
   </div>

</section>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>
