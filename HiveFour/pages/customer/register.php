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
    $profilePic = "../../assets/userPic/default.jpg";

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    /* execute SQL SELECT command */
    $sql = "SELECT User_Name FROM users WHERE User_Name = '$username'";
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
        $sql2 = "INSERT INTO users (User_ID, User_Name, User_Email, User_Password, User_Full_Name, Type_ID, Profile_Pic) VALUES ('$uId','$username', '$email', '$hashed_password', '$fullName', '$typeID', '$profilePic')";
        $sql3 = "INSERT INTO user_details (User_Details_ID, Phone_No, Address1, Address2, Postcode, City, State, User_ID) VALUES ('$udId', '$phoneNumber', '$address1', '$address2', '$postcode', '$city', '$state', '$uId')";

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
    $sqlSelectMaxId = "SELECT User_Details_ID FROM user_details ORDER BY User_Details_ID DESC LIMIT 1";
    $result = mysqli_query($dbconn, $sqlSelectMaxId);
    if (!$result) {
        die("Error: " . mysqli_error($dbconn));
    }

    $row = mysqli_fetch_assoc($result);
    $lastId = $row['User_Details_ID'];
    
    // Extract the numeric part, increment it, and create the new ID
    $numericPart = intval(substr($lastId, 2)); // assuming the prefix "UD" is always 2 characters
    $newNumericPart = $numericPart + 1;
    if ($newNumericPart < 10) {
        $newUserId = 'UD0' . $newNumericPart;
    } else {
        $newUserId = 'UD' . $newNumericPart;
    }
    return $newUserId;
}
?>
