<?php
include 'config.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['send'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = $_POST['number'];
    $order_id = $_POST['order_id'];
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

    $select_complaint = mysqli_query($conn, "SELECT * FROM `complaints` WHERE name = '$name' AND email = '$email' AND number = '$number' AND order_id = '$order_id' AND message = '$msg'") or die('Query failed');

    if (mysqli_num_rows($select_complaint) > 0) {
        $message[] = 'Complaint already submitted!';
    } else {
        $targetFilePath = null; // Initialize the target file path as NULL

       
        if (isset($_POST['photo-data']) && !empty($_POST['photo-data'])) {
            $dataURI = $_POST['photo-data'];
            $encodedData = explode(',', $dataURI)[1];
            $decodedData = base64_decode($encodedData);
            $generatedFileName = "img_" . time() . ".jpg";
            $targetFilePath = "uploaded_img/" . $generatedFileName;
            file_put_contents($targetFilePath, $decodedData);
            $message[] = 'Photo captured and uploaded successfully!';
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
            <div class="input-group">
                <input type="text" name="order_id" required placeholder="Enter your order ID" class="box" value="<?php echo isset($_GET['order_id']) ? $_GET['order_id'] : ''; ?>">
            </div>
            <div class="input-group">
                <input type="text" name="name" required placeholder="Enter your name" class="box" value="<?php echo isset($_GET['name']) ? $_GET['name'] : ''; ?>">
            </div>
            <div class="input-group">
                <input type="email" name="email" required placeholder="Enter your email" class="box" value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>">
            </div>
            <div class="input-group">
                <input type="number" name="number" required placeholder="Enter your number" class="box" value="<?php echo isset($_GET['number']) ? $_GET['number'] : ''; ?>">
            </div>
            <textarea name="message" class="box" placeholder="Enter your complaint" id="" cols="30" rows="10"></textarea>
            <br><br>
            <div class="input-group">
                <h3 style="font-size: 160%">Choose Photo Source:</h3>
                    <input type="radio" name="photo-source" id="photo-source-webcam" value="webcam" onclick="togglePhotoSource('webcam')">
                    <label for="photo-source-webcam" style="font-size: 140%; padding-right: 10px">Webcam</label>
                    <input type="radio" name="photo-source" id="photo-source-file" value="file" onclick="togglePhotoSource('file')">
                    <label for="photo-source-file" style="font-size: 140%; ">File</label>
                    <br><br>
                <div id="webcam-container" style="display: none;">          
            </div>
                <div id="file-container" style="display: none;">
                    <input type="file" name="photo" id="photo" accept="image/*" class="box" onchange="handleFileSelect(event)">
                </div>
                <canvas id="captured-image" style="display: none;"></canvas>
                <img id="preview" style="display: none;">
            </div>
          
            <button type="button" id="take-picture-btn" onclick="takePicture()" class="box" style = "display:none;">Take a Picture</button>
            <input type="submit" value="Submit Complaint" name="send" class="btn">
        </form>
    </section>

    <?php include 'footer.php'; ?>

    <!-- WebcamJS library -->
    <script src="js/webcam.min.js"></script>

    <script>
        // Function to toggle the photo source options
        function togglePhotoSource(source) {
        var webcamContainer = document.getElementById('webcam-container');
        var fileContainer = document.getElementById('file-container');
        var takePictureBtn = document.getElementById('take-picture-btn');

        if (source === 'webcam') {
            webcamContainer.style.display = 'block';
            fileContainer.style.display = 'none';
             takePictureBtn.style.display = 'block';
             Webcam.attach('#webcam-container'); // Attach webcam when chosen
           
        } else if (source === 'file') {
            webcamContainer.style.display = 'none';
            fileContainer.style.display = 'block';
            takePictureBtn.style.display = 'none';
            Webcam.reset(); // Reset webcam when not chosen
        }
    }

        // Initialize WebcamJS
        Webcam.set({
            width: 320,
            height: 240,
            dest_width: 320,
            dest_height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        // Attach Webcam to the container
        Webcam.attach('#webcam-container');

        // Take picture and populate the hidden input field with the captured image data
        function takePicture() {
            Webcam.snap(function(dataURI) {
                var capturedImage = document.getElementById('captured-image');
                var preview = document.getElementById('preview');
                var photoData = document.getElementById('photo-data');

                capturedImage.style.display = 'block';
                capturedImage.src = dataURI;
                preview.style.display = 'block';
                preview.src = dataURI;
                photoData.value = dataURI;
            });
        }

        // Handle file selection
        function handleFileSelect(event) {
            var file = event.target.files[0];
            var reader = new FileReader();
            var capturedImage = document.getElementById('captured-image');
            var photoData = document.getElementById('photo-data');

            reader.onload = function(e) {
                capturedImage.style.display = 'block';
                capturedImage.src = e.target.result;
                photoData.value = e.target.result;
            };

            reader.readAsDataURL(file);
        }
    </script>
</body>
</html>