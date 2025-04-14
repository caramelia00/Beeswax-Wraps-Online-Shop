<?php
    session_start();
	include '../../config/dbconn.php';

    ##If the submit button is clicked 
    if(isset($_POST['submitOrder'])){

    $uId = $_SESSION['User_ID'];
    $oId = createOrderId();
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $date = date("Y-m-d");
    $time = date("h:i:s");
    $pId= $_POST['pId']; 
    $sId= $_POST['sId']; 
    $qty= $_POST['qty']; 

    if(empty($_FILES['receipt']['name']) || $_FILES['receipt']['error'] == UPLOAD_ERR_NO_FILE) { //checking if file is empty
        // Display the alert
        echo "<script>alert('Upload a receipt!!'); 
            window.location.href = 'checkout.php';
        </script>";
        exit();
    }else{
        // receipt upload handling
        if(isset($_FILES['receipt']) && $_FILES['receipt']['error'] == 0){
            $file = $_FILES['receipt'];

            $fileName = $_FILES['receipt']['name'];
            $fileTmpName = $_FILES['receipt']['tmp_name'];
            $fileSize = $_FILES['receipt']['size'];
            $fileError = $_FILES['receipt']['error'];
            $fileType = $_FILES['receipt']['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg','jpeg','png','pdf');

            if(in_array($fileActualExt, $allowed)) {
                if($fileError === 0) {
                    //file size must be < 10MB
                    if($fileSize < 10485760) {
                        $fileNameNew = $oId.".".$fileActualExt;
                        $fileDestination = '../../assets/payReceipt/'. $fileNameNew;

                        move_uploaded_file($fileTmpName, $fileDestination); //to upload file to a specific folder

                        //insert new order
                        $sqlInsertOrd = "INSERT INTO orders (Order_ID, Order_Date, Order_Time, Status_ID, User_ID, Payment_Receipt) VALUES(
                            '" . $oId . "',
                            '" . $date . "',
                            '" . $time . "',
                            'S01',
                            '" . $uId . "',
                            '" . $fileDestination . "')";
                            //echo $sqlInsertProd;
                            mysqli_query($dbconn, $sqlInsertOrd) or die ("Error: " . mysqli_error($dbconn));

                        // Loop through each item in the cart
                        foreach ($_SESSION['cart'] as $cartItem) {
                            // Get product details
                            $pId = $cartItem['productId'];
                            $sId = $cartItem['sizeId'];
                            $qty = $cartItem['quantity'];

                            // Insert order details for each item
                            $orderDetailsId = createOrderDetailsId();
                            $sqlInsertOrdDetails = "INSERT INTO order_details (Order_Details_ID, Quantity, Product_ID, Order_ID, Size_ID) VALUES (
                                '" . $orderDetailsId . "',
                                '" . $qty . "',
                                '" . $pId . "',
                                '" . $oId . "',
                                '" . $sId . "'
                            )";
                            //echo $sqlInsertOrdDetails;
                            mysqli_query($dbconn, $sqlInsertOrdDetails) or die ("Error: " . mysqli_error($dbconn));
                        }
                        
                        //clear item in cart
                        foreach($_SESSION['cart'] as $key => $value) {
                            unset($_SESSION['cart'][$key]);
                        }

                        // Display the alert
                        echo "<script>alert('The new order has been placed'); 
                            window.location.href = 'order.php';
                            </script>";
                        exit();

                    } else {
                        echo "<script>
                            alert('File is too big!');
                            window.location.href = 'checkout.php';
                        </script>";   
                    }
                } else {
                    echo "<script>
                        alert('There is an error in this file!');
                        window.location.href = 'checkout.php';
                    </script>";  
                }
            } else {
                echo "<script>
                    alert('PNG, JPG, JPEG, PDF only!');
                    window.location.href = 'checkout.php';
                </script>";  
            }
        }
    }
}

    //create new order id
    function createOrderId(){
        include '../../config/dbconn.php';

        //Find the highest current product ID
        $sqlSelectMaxId = "SELECT Order_ID FROM orders ORDER BY Order_ID DESC LIMIT 1";
        $result = mysqli_query($dbconn, $sqlSelectMaxId);

        $row = mysqli_fetch_assoc($result);
        $lastId = $row['Order_ID'];
        
        //Extract the numeric part, increment it, and create the new ID
        $numericPart = intval(substr($lastId, 1)); // assuming the prefix "PD" is always 2 characters
        $newNumericPart = $numericPart + 1;
        if($newNumericPart<10)
            $newProductId = 'O0' . $newNumericPart;
        else
            $newProductId = 'O' . $newNumericPart;

        return $newProductId;
    }

    //create new order details id
    function createOrderDetailsId(){
        include '../../config/dbconn.php';
    
        // Find the highest current Order_Details_ID
        $sqlSelectMaxId = "SELECT MAX(Order_Details_ID) AS maxId FROM order_details";
        $result = mysqli_query($dbconn, $sqlSelectMaxId);
        $row = mysqli_fetch_assoc($result);
        $maxId = $row['maxId'];
    
        // If no records exist, start from 'OD001'
        if (!$maxId) {
            return 'OD01';
        }
    
        // Extract the numeric part, increment it, and create the new ID
        $numericPart = intval(substr($maxId, 2));
        $newNumericPart = $numericPart + 1;
        if ($newNumericPart < 10) {
            return 'OD0' . $newNumericPart;
        } else {
            return 'OD' . $newNumericPart;
        }
    }
    

?>