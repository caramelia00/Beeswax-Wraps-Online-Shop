<?php
/* include db connection file syaaaa */
include '../../config/dbconn.php';

if(isset($_POST['Submit'])){
    /* capture values from HTML form */
    $uId = createUserId();
    $udId = createUserDetailsId();
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $fullName = $_POST['fullName'];
    $phoneNumber = $_POST['phoneNumber'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $postcode = $_POST['postcode'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $typeID = "UT01";

    /* execute SQL SELECT command */
    $sql = "SELECT User_Name FROM users WHERE User_Name = '$username'";
    echo $sql;
    $query = mysqli_query($dbconn, $sql);

    if (!$query) {
        die("Error: " . mysqli_error($dbconn));
    }

    $row = mysqli_num_rows($query);

    if($row != 0){
        echo "<script>alert('The username is already existed'); 
                window.location.href = 'register1.php';
                </script>";
            exit();
    }
    else{
        /* execute SQL INSERT commands */
        $sql2 = "INSERT INTO users (User_ID, User_Name, User_Email, User_Password, User_Full_Name, Type_ID) VALUES ('$uId','$username', '$email', '$password', '$fullName', '$typeID')";
        $sql3 = "INSERT INTO user_details (User_Details_ID, Phone_No, Address1, Address2, Postcode, City, State) VALUES ('$udId', '$phoneNumber', '$address1', '$address2', '$postcode', '$city', '$state')";

        if (mysqli_query($dbconn, $sql2) && mysqli_query($dbconn, $sql3)) {
            echo "<script>alert('Succesfully registered!'); 
                window.location.href = 'login.php';
                </script>";
            exit();
        } else {
            echo "Error: " . mysqli_error($dbconn);
        }
    }
}

/* close db connection */
mysqli_close($dbconn);

// create new user id
function createUserId(){
    include '../../config/dbconn.php';

    // Find the highest current user ID
    $sqlSelectMaxId = "SELECT User_ID FROM users ORDER BY User_ID DESC LIMIT 1";
    $result = mysqli_query($dbconn, $sqlSelectMaxId);
    if (!$result) {
        die("Error: " . mysqli_error($dbconn));
    }

    $row = mysqli_fetch_assoc($result);
    $lastId = $row['User_ID'];
    
    // Extract the numeric part, increment it, and create the new ID
    $numericPart = intval(substr($lastId, 1)); // assuming the prefix "U" is always 1 character
    $newNumericPart = $numericPart + 1;
    if ($newNumericPart < 10) {
        $newUserId = 'U0' . $newNumericPart;
    } else {
        $newUserId = 'U' . $newNumericPart;
    }
    return $newUserId;
}

// create new user details id
function createUserDetailsId(){
    include '../../config/dbconn.php';

    // Find the highest current user details ID
    $sqlSelectMaxId = "SELECT User_ID FROM user_details ORDER BY User_Details_ID DESC LIMIT 1";
    $result = mysqli_query($dbconn, $sqlSelectMaxId);
    if (!$result) {
        die("Error: " . mysqli_error($dbconn));
    }

    $row = mysqli_fetch_assoc($result);
    $lastId = $row['User_ID'];
    
    // Extract the numeric part, increment it, and create the new ID
    $numericPart = intval(substr($lastId, 2)); // assuming the prefix "UD" is always 2 characters
    $newNumericPart = $numericPart + 1;
    if ($newNumericPart < 10) {
        $newUserId = 'UD0' . $newNumericPart;
    } else {
        $newUserId = 'UD' . $newNumericPart;
    }
    return $newUserId;

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
}
?>