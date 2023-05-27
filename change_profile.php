<?php

include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
   header('location:login.php');
   exit();
}

$user_id = $_SESSION['user_id'];

$select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'");
$user = mysqli_fetch_assoc($select_user);

if (isset($_POST['submit'])) {
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $old_password = mysqli_real_escape_string($conn, $_POST['old_password']);
   $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
   $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

   $old_password_hash = md5($old_password);

   // Check if the provided old password is correct
   if ($user['password'] === $old_password_hash) {
      // Check if the new password and confirm password match
      if ($new_password === $confirm_password) {
         // Update the password if both conditions are met
         $password = mysqli_real_escape_string($conn, md5($new_password));
         $update_user = mysqli_query($conn, "UPDATE `users` SET name = '$name', email = '$email', password = '$password' WHERE id = '$user_id'");
         if ($update_user) {
            $_SESSION['user_name'] = $name;
            $_SESSION['user_email'] = $email;
            header('location: home.php?success=1&message=Profile updated successfully!');
            exit();
         } else {
            $message = 'Failed to update profile!';
         }
      } else {
         $message = 'New password and confirm password do not match!';
      }
   } else {
      $message = 'Invalid old password!';
   }

   // Fetch the user again after failed update attempt
   $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'");
   $user = mysqli_fetch_assoc($select_user);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Change Profile</title>

   <!-- font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


   <!-- custom css file link -->
   <link rel="stylesheet" href="css/style.css">

   <script src="js/script.js"></script>
</head>
<body>

<?php
if (isset($message)) {
   echo '
   <div class="message">
      <span>' . $message . '</span>
      <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
   </div>
   ';
}
?>

<div class="form-container">
   <form action="" method="post">
      <h3>Change Profile</h3>
      <div>
         <p>
            <span id="name-text"><?php echo $user['name']; ?></span>
            <button type="button" id="name-edit" class="edit-btn" onclick="enableEdit('name')"><i class="fas fa-pencil-alt"></i></button>
         </p>
         <input type="text" id="name-input" name="name" class="box" value="<?php echo $user['name']; ?>" style="display: none;">
      </div>
      <div>
         <p>
            <span id="email-text"><?php echo $user['email']; ?></span>
            <button type="button" id="email-edit" class="edit-btn" onclick="enableEdit('email')"><i class="fas fa-pencil-alt"></i></button>
         </p>
         <input type="email" id="email-input" name="email" class="box" value="<?php echo $user['email']; ?>" style="display: none;">
      </div>
      <div>
         <button type="button" class="edit-btn" onclick="showPasswordFields()">Change Password</button>
         <div id="password-fields" class="password-fields">
   <div class="password-toggle">
      <input type="password" name="old_password" id="old-password" placeholder="Enter your old password" class="box">
      <span class="toggle-password" onclick="togglePasswordVisibility('old-password')"><i class="fas fa-eye"></i></span>
   </div>
   <div class="password-toggle">
      <input type="password" name="new_password" id="new-password" placeholder="Enter your new password" class="box">
      <span class="toggle-password" onclick="togglePasswordVisibility('new-password')"><i class="fas fa-eye"></i></span>
   </div>
   <div class="password-toggle">
      <input type="password" name="confirm_password" id="confirm-password" placeholder="Confirm new password" class="box">
      <span class="toggle-password" onclick="togglePasswordVisibility('confirm-password')"><i class="fas fa-eye"></i></span>
   </div>
</div>
    
    </div>
      <input type="submit" name="submit" value="Update Profile" class="btn">
      <p><a href="home.php">Back to Home</a></p>
   </form>
</div>

</body>
</html>
