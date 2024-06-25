<?php
## Include db connection file 
include '../../config/dbconn.php';

## If the update button is clicked 
if(isset($_POST['update'])) {

    ## Capture values from HTML form 
    $pId = $_POST['pId']; 
    $pName = $_POST['pName']; 
    $pStatus = $_POST['newStatus'];

    ## Check if product name is empty
    if (empty($pName)) {
        echo "<script>
                alert('Product name cannot be empty!');
                window.location.href = 'admin update product.php?pId=$pId';
              </script>";
        exit();
    }

    ## Image upload handling
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
                // File size must be < 10MB
                if($fileSize < 10485760) {
                    $fileNameNew = $pId.".".$fileActualExt;
                    $fileDestination = '../../assets/prodPic/'. $fileNameNew;

                    move_uploaded_file($fileTmpName, $fileDestination); // To upload file to a specific folder

                    $sqlUpdateImage = "UPDATE product SET Product_Image = '$fileDestination' WHERE Product_ID = '$pId'";
                    mysqli_query($dbconn, $sqlUpdateImage) or die ("Error: " . mysqli_error($dbconn));
                } else {
                    echo "<script>
                            alert('File is too big!');
                            window.location.href = 'admin update product.php?pId=$pId';
                          </script>";   
                    exit();
                }
            } else {
                echo "<script>
                        alert('There is an error in this file!');
                        window.location.href = 'admin update product.php?pId=$pId';
                      </script>";  
                exit();
            }
        } else {
            echo "<script>
                    alert('PNG, JPG, JPEG only!');
                    window.location.href = 'admin update product.php?pId=$pId';
                  </script>";  
            exit();
        }
    } else {
        echo "<script>
                alert('Product image cannot be empty!');
                window.location.href = 'admin update product.php?pId=$pId';
              </script>";
        exit();
    }

    $sqlUpdate = "UPDATE product SET Product_Name = '$pName',  Product_Status_ID = '$pStatus' WHERE Product_ID = '$pId'";
    mysqli_query($dbconn, $sqlUpdate) or die ("Error: " . mysqli_error($dbconn));

    /* Display a message */
    echo "<script>
            alert('Data has been updated');
            window.location.href = 'admin product list.php';
          </script>";   
}
?>
