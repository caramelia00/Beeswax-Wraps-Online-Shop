<?php
include '../../config/dbconn.php';

if (isset($_GET['productId']) && isset($_GET['newStatus'])) {
    $productId = $_GET['productId'];
    $newStatus = $_GET['newStatus'];
    
    $sql = "UPDATE product SET Product_Status_ID = '$newStatus' WHERE Product_ID = '$productId'";
    mysqli_query($dbconn, $sql);

    // Redirect back to the product list to prevent resubmission on refresh
    echo "
    <script>
        alert('Status has been updated');
        window.location.href = 'admin product list.php';
        </script>";
    exit();
}
?>
