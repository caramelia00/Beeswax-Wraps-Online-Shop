<?php
/* include db connection file */
include("dbconn.php");

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

    $query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));

    $row = mysqli_num_rows($query);

    if($row != 0){
        echo "Record is existed";
    }
    else{
        /* execute SQL INSERT command */
        $sql2 = "INSERT INTO users (User_ID, User_Name, User_Email, User_Password, User_Full_Name, Type_ID) VALUES ($uId,'$username', '$email', '$password', '$fullName', $typeID)";
        $sql3 = "INSERT INTO user_details (User_ID, Phone_No, Address1, Address2, Postcode, City, State) VALUES ($udId, '$phoneNumber', '$address1', '$address2', '$postcode', '$city', '$state')";

        mysqli_query($dbconn, $sql2, $sql3) or die ("Error: " . mysqli_error($dbconn));

        /* display a message */
        echo "Data has been saved";
    }
}// close if isset()

/* close db connection */
mysqli_close($dbconn);

    //create new user id
    function createUserId(){
        include '../../config/dbconn.php';

        //Find the highest current user ID
        $sqlSelectMaxId = "SELECT User_ID FROM users ORDER BY User_ID DESC LIMIT 1";
        $result = mysqli_query($dbconn, $sqlSelectMaxId);

        $row = mysqli_fetch_assoc($result);
        $lastId = $row['User_ID'];
        
        //Extract the numeric part, increment it, and create the new ID
        $numericPart = intval(substr($lastId, 1)); // assuming the prefix "PD" is always 2 characters
        $newNumericPart = $numericPart + 1;
        if($newNumericPart<10)
            $newUserId = 'U0' . $newNumericPart;
        else    
            $newUserId = 'U' . $newNumericPart;
        return $newUserId;
    }
        //create new user details id
        function createUserDetailsId(){
            include '../../config/dbconn.php';
    
            //Find the highest current product ID
            $sqlSelectMaxId = "SELECT User_ID FROM user_details ORDER BY User_ID DESC LIMIT 1";
            $result = mysqli_query($dbconn, $sqlSelectMaxId);
    
            $row = mysqli_fetch_assoc($result);
            $lastId = $row['User_ID'];
            
            //Extract the numeric part, increment it, and create the new ID
            $numericPart = intval(substr($lastId, 1)); // assuming the prefix "PD" is always 2 characters
            $newNumericPart = $numericPart + 1;
            if($newNumericPart<10)
                $newUserId = 'U0' . $newNumericPart;
            else    
                $newUserId = 'U' . $newNumericPart;
            return $newUserId;
        }
?>