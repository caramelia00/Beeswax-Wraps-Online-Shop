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

        // Image upload handling
        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
            $file = $_FILES['image'];

            $fileName = $_FILES['image']['name'];
            $fileTmpName = $_FILES['image']['tmp_name'];
            $fileSize = $_FILES['image']['size'];
            $fileError = $_FILES['image']['error'];
            $fileType = $_FILES['image']['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg','jpeg','png');

            if(in_array($fileActualExt, $allowed)) {
                if($fileError === 0) {
                    //file size must be < 10MB
                    if($fileSize < 10485760) {
                        $fileNameNew = $uId.".".$fileActualExt;
                        $fileDestination = '../../assets/userPic/'. $fileNameNew;

                        move_uploaded_file($fileTmpName, $fileDestination); //to upload file to a specific folder

                        $sqlUpdateImage = "UPDATE users SET Profile_Pic = '$fileDestination' WHERE User_ID = '$uId'";
                        mysqli_query($dbconn, $sqlUpdateImage) or die ("Error: " . mysqli_error($dbconn));
                    } else {
                        echo "<script>
                            alert('File is too big!');
                            window.location.href = 'admin product list.php';
                        </script>";   
                    }
                } else {
                    echo "<script>
                        alert('There is an error in this file!');
                        window.location.href = 'admin product list.php';
                    </script>";  
                }
            } else {
                echo "<script>
                    alert('PNG, JPG, JPEG only!');
                    window.location.href = 'admin product list.php';
                </script>";  
            }
        }
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