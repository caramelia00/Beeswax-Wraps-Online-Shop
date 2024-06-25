<?php
session_start();

##include db connection file 
include '../../config/dbconn.php';

##If the update button is clicked 
if(isset($_POST['update'])){

    ##	capture values from HTML form  
    $priceS= $_POST['priceS']; 
    $priceM= $_POST['priceM']; 
    $priceL= $_POST['priceL'];

    if($priceS == "" || $priceM == "" || $priceL == "") {
        // Display the alert
        echo "<script>alert('One or more prices are empty!'); 
        window.location.href = 'update price.php';
        </script>";
        exit();
    }    

    ## execute SQL UPDATE command 
    $sqlUpdateS = "UPDATE size SET Size_Price = '" . $priceS . "'
    WHERE Size_ID = 'S'";
    mysqli_query($dbconn, $sqlUpdateS) or die ("Error: " . mysqli_error($dbconn));

    $sqlUpdateS = "UPDATE size SET Size_Price = '" . $priceM . "'
    WHERE Size_ID = 'M'";
    mysqli_query($dbconn, $sqlUpdateS) or die ("Error: " . mysqli_error($dbconn));

    $sqlUpdateS = "UPDATE size SET Size_Price = '" . $priceL . "'
    WHERE Size_ID = 'L'";
    mysqli_query($dbconn, $sqlUpdateS) or die ("Error: " . mysqli_error($dbconn));


    /* display a message */
    echo "<script>
            alert('Data has been updated');
            window.location.href = 'admin product list.php';
        </script>";
        
}
?>