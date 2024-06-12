<?php
##include db connection file 
include '../../config/dbconn.php';

##If the delete button is clicked 
    ## capture values from URL parameter 
    $oId = $_GET['orderId'];

    ## execute SQL DELETE command 
    $sqlDeleteOrderDetails = "DELETE FROM order_details WHERE Order_ID = '$oId'";
    mysqli_query($dbconn, $sqlDeleteOrderDetails) or die ("Error: " . mysqli_error($dbconn));

    $sqlDeleteOrder = "DELETE FROM orders WHERE Order_ID = '$oId'";
    mysqli_query($dbconn, $sqlDeleteOrder) or die ("Error: " . mysqli_error($dbconn));
    
    /* display a message */
    echo "<script>
            alert('Order has been deleted');
            window.location.href = 'admin orders.php';
          </script>";
?>
