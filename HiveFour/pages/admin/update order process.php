<?php
session_start();

##include db connection file 
include '../../config/dbconn.php';

##If the update button is clicked 
if(isset($_POST['update'])){

    ##	capture values from HTML form 
        $oId= $_POST['oId']; 
        $oStatus = $_POST['newStatus'];

        ## execute SQL UPDATE command 
        $sqlUpdate = "UPDATE orders SET Status_ID = '" . $oStatus . "'
        WHERE Order_ID = '" . $oId . "'";
        
        mysqli_query($dbconn, $sqlUpdate) or die ("Error: " . mysqli_error($dbconn));
        /* display a message */
        echo "<script>
                alert('Order status has been updated');
                window.location.href = 'admin orders.php';
            </script>";
}
?>