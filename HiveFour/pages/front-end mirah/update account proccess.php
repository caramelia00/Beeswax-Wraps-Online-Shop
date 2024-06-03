<?php
session_start();

##include db connection file 
include '../../config/dbconn.php';

##If the update button is clicked 
if(isset($_POST['update'])){

    ##	capture values from HTML form 
    if($_POST['pw'] != $_POST['confirmPw'] ){
        echo "<script>
            alert('Password is not matching');
            window.location.href = 'admin edit details.php';
          </script>";
    }else{
        $uId= $_SESSION['User_ID']; 
        //$uName= $_POST['User_Name']; 
        $uFullName= $_POST['fullname']; 
        $uEmail= $_POST['email']; 
        $pw= $_POST['pw'];
        $confirmPw = $_POST['confirmPw'];
        
        ## apply sql statement to verify the specified info first
        $sqlSel = "SELECT * FROM users WHERE User_ID= '$uId'";
        $querySel = mysqli_query($dbconn, $sqlSel) or die ("Error: " . mysqli_error($dbconn));
        $rowSel = mysqli_num_rows($querySel);

        ## execute SQL UPDATE command 
        $sqlUpdate = "UPDATE users SET User_Full_Name = '" . $uFullName . "',
        User_Email= '" . $uEmail . "', User_Password = '" . $pw . "'
        WHERE User_ID = '" . $uId . "'";
        
        mysqli_query($dbconn, $sqlUpdate) or die ("Error: " . mysqli_error($dbconn));
        /* display a message */
        echo "<script>
                alert('Data has been updated');
                window.location.href = 'admin view account.php';
            </script>";
        
    }
}
?>