<?php

include 'config.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}

$message = array(); // Initialize the message array

if(isset($_POST['send'])){
   // Code for sending a message
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = $_POST['number'];
   $msg = mysqli_real_escape_string($conn, $_POST['message']);

   $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email'") or die('query failed');

   if(mysqli_num_rows($select_message) > 0){
      $message[] = 'Message has already been sent!';
   } else {
      mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
      $message[] = 'Message sent successfully!';
   }
}

if(isset($_POST['request'])){
   // Code for requesting a product
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $category = mysqli_real_escape_string($conn, $_POST['category']);

   
      mysqli_query($conn, "INSERT INTO `request`(user_id, name, category) VALUES('$user_id', '$name', '$category')") or die('query failed');
      $message[] = 'Request sent successfully!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="heading">
   <h3>contact us</h3>
   <p> <a href="home.php">home</a> / contact </p>
</div>

<section class="contact">

   <form action="" method="post">
      <h3>say something!</h3>
      <input type="text" name="name" required placeholder="enter your name" class="box">
      <input type="email" name="email" required placeholder="enter your email" class="box">
      <input type="number" name="number" required placeholder="enter your number" class="box">
      <textarea name="message" class="box" placeholder="enter your message" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="send message" name="send" class="btn">
   </form>

</section>

<section class="contact">

   <form action="" method="post">
      <h3>Request For Product</h3>
      <input type="text" name="name" required placeholder="Enter Product Name" class="box">
      <input type="text" name="category" required placeholder="Category" class="box">
      <input type="submit" value="send request" name="request" class="btn">
   </form>

</section>

<?php
// Display messages
if(!empty($message)) {
   foreach($message as $msg) {
      echo '<p>'.$msg.'</p>';
   }
}
?>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
