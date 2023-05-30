<?php

include 'config.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
} else{
   $user_id = '';
}

if(isset($_POST['send'])){
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = $_POST['number'];
   $order_id = $_POST['order_id'];
   $msg = mysqli_real_escape_string($conn, $_POST['message']);

   $select_complaint = mysqli_query($conn, "SELECT * FROM `complaints` WHERE name = '$name' AND email = '$email' AND number = '$number' AND order_id = '$order_id' AND message = '$msg'") or die('Query failed');

   if(mysqli_num_rows($select_complaint) > 0){
      $message[] = 'Complaint already submitted!';
   } else{
      $targetFilePath = null; // Initialize the target file path as NULL
      
      if(!empty($_FILES["photo"]["name"])) {
         // File upload handling
         $targetDir = "uploaded_img/";
         $fileName = basename($_FILES["photo"]["name"]);
         $targetFilePath = $targetDir . $fileName;
         $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
   
         if(move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)){
            $message[] = 'Photo uploaded successfully!';
         } else{
            $message[] = 'Failed to upload photo!';
         }
      }
      
      mysqli_query($conn, "INSERT INTO `complaints` (user_id, name, email, number, order_id, message, photo) VALUES ('$user_id', '$name', '$email', '$number', '$order_id', '$msg', '$targetFilePath')") or die('Query failed');
      $message[] = 'Complaint submitted successfully!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Complaint</title>

   <!-- font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Complaint Box</h3>
   <p><a href="home.php">Home</a> / Complaint</p>
</div>

<section class="contact">
   <form action="" method="post" enctype="multipart/form-data">
      <h3>File a Complaint!</h3>
      <input type="text" name="order_id" required placeholder="Enter your order ID" class="box" value="<?php echo isset($_GET['order_id']) ? $_GET['order_id'] : ''; ?>">
      <input type="text" name="name" required placeholder="Enter your name" class="box" value="<?php echo isset($_GET['name']) ? $_GET['name'] : ''; ?>">
      <input type="email" name="email" required placeholder="Enter your email" class="box" value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>">
      <input type="number" name="number" required placeholder="Enter your number" class="box" value="<?php echo isset($_GET['number']) ? $_GET['number'] : ''; ?>">
      <textarea name="message" class="box" placeholder="Enter your complaint" id="" cols="30" rows="10"></textarea>
      <input type="file" name="photo" accept="image/*" class="box">
      <input type="submit" value="Submit Complaint" name="send" class="btn">
   </form>
</section>

<?php include 'footer.php'; ?>

<!-- custom js file link -->
<script src="js/script.js"></script>

</body>
</html>
