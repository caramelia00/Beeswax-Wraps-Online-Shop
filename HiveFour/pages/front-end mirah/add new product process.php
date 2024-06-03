<?php
	include '../../config/dbconn.php';

    $pId = createProductId();
    $pName= $_REQUEST['pName']; 
    $priceS= $_REQUEST['pSmall']; 
    $priceM= $_REQUEST['pMed']; 
    $priceL= $_REQUEST['pLarge'];
    $psIdS = $pId . 'S';
    $psIdM = $pId . 'M';
    $psIdL = $pId . 'L';

    if($pName == ""){ //checking if product name is empty
        // Display the alert
        echo "<script>alert('Product name is empty!'); 
        window.location.href = 'add new product.php';
        </script>";
        exit();
    }else{
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

                        //insert new product into product
                        $sqlInsertProd = "INSERT INTO product VALUES(
                            '" . $pId . "',
                            '" . $pName . "',
                            '" . $fileDestination . "')";
                            //echo $sqlInsertProd;
                            mysqli_query($dbconn, $sqlInsertProd) or die ("Error: " . mysqli_error($dbconn));
                        
                        //insert the product price for each size into product size
                        $sqlInsertProdSize = "INSERT INTO product_size (Product_Size_ID, Product_ID, Size_ID, Size_Price) VALUES 
                        ('$psIdS', '$pId', 'S', '$priceS'),
                        ('$psIdM', '$pId', 'M', '$priceM'),
                        ('$psIdL', '$pId', 'L', '$priceL')";
                        mysqli_query($dbconn, $sqlInsertProdSize) or die ("Error: " . mysqli_error($dbconn));

                        // Display the alert
                        echo "<script>alert('The new product has been recorded in the DB'); 
                            window.location.href = 'admin product list.php';
                            </script>";
                        exit();

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
    }

    //create new product id
    function createProductId(){
        include '../../config/dbconn.php';

        //Find the highest current product ID
        $sqlSelectMaxId = "SELECT Product_ID FROM product ORDER BY Product_ID DESC LIMIT 1";
        $result = mysqli_query($dbconn, $sqlSelectMaxId);

        $row = mysqli_fetch_assoc($result);
        $lastId = $row['Product_ID'];
        
        //Extract the numeric part, increment it, and create the new ID
        $numericPart = intval(substr($lastId, 2)); // assuming the prefix "PD" is always 2 characters
        $newNumericPart = $numericPart + 1;
        $newProductId = 'PD' . $newNumericPart;

        return $newProductId;
    }
?>