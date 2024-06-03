<?php
##include db connection file 
include '../../config/dbconn.php';

##If the update button is clicked 
if(isset($_POST['update'])){

    ##	capture values from HTML form 

    $pId= $_POST['pId']; 
    $pName= $_POST['pName']; 
    $priceS= $_POST['pSmall']; 
    $priceM= $_POST['pMed']; 
    $priceL= $_POST['pLarge'];
    $qtyS= $_POST['pSmallQty']; 
    $qtyM= $_POST['pMedQty']; 
    $qtyL= $_POST['pLargeQty'];

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
                    $fileNameNew = $pId.".".$fileActualExt;
                    $fileDestination = '../../assets/prodPic/'. $fileNameNew;

                    move_uploaded_file($fileTmpName, $fileDestination); //to upload file to a specific folder

                    $sqlUpdateImage = "UPDATE product SET Product_Image = '$fileDestination' WHERE Product_ID = '$pId'";
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

    ## apply sql statement to verify the specified info first
    $sqlSel = "SELECT * FROM product_size WHERE Product_ID= '$pId'";
    $querySel = mysqli_query($dbconn, $sqlSel) or die ("Error: " . mysqli_error($dbconn));
    $rowSel = mysqli_num_rows($querySel);

    ## execute SQL UPDATE command 
    $sqlUpdateS = "UPDATE product_size SET Size_Price = '$priceS', Size_Stock = '$qtyS' WHERE Product_ID = '$pId' AND Size_ID = 'S'";
    mysqli_query($dbconn, $sqlUpdateS) or die ("Error: " . mysqli_error($dbconn));

    $sqlUpdateM = "UPDATE product_size SET Size_Price = '$priceM', Size_Stock = '$qtyM' WHERE Product_ID = '$pId' AND Size_ID = 'M'";
    mysqli_query($dbconn, $sqlUpdateM) or die ("Error: " . mysqli_error($dbconn));

    $sqlUpdateL = "UPDATE product_size SET Size_Price = '$priceL', Size_Stock = '$qtyL' WHERE Product_ID = '$pId' AND Size_ID = 'L'";
    mysqli_query($dbconn, $sqlUpdateL) or die ("Error: " . mysqli_error($dbconn));

    /* display a message */
    echo "<script>
            alert('Data has been updated');
            window.location.href = 'admin product list.php';
        </script>";   
}
?>
