<?php
session_start();

include '../../config/dbconn.php';

if (!isset($_SESSION['User_ID'])) {
    die("User is not logged in.");
}

$userId = $_SESSION['User_ID'];

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['pw'];
$ad1 = $_POST['ad1'];
$ad2 = $_POST['ad2'];
$pc = $_POST['pc'];
$city = $_POST['city'];
$state = $_POST['state'];
$pn = $_POST['pn'];

// Update user details in the database
$sql = "UPDATE users SET User_Full_Name = ?, User_Email = ?, User_Password = ?, Address1 = ?, Address2 = ?, Postcode = ?, City = ?, State = ?, Phone_Number = ? WHERE User_ID = ?";
$stmt = $dbconn->prepare($sql);
$stmt->bind_param("sssssssssi", $fullname, $email, $password, $ad1, $ad2, $pc, $city, $state, $pn, $userId);

if ($stmt->execute()) {
    echo "Details updated successfully.";
} else {
    echo "Error updating details: " . $stmt->error;
}

//new user to upload image (pfp)
$target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".<br>";
            $uploadOk = 1;
        } else {
            echo "File is not an image.<br>";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.<br>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, the file is too large.<br>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.<br>";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) 
        {
            echo "The file ". htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
        } else
        {
            echo "Sorry, there was an error uploading your file.<br>";
        }
    }
$stmt->close();
$dbconn->close();
?>