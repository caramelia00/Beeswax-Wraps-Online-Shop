<?php
    session_start();
    include '../../config/dbconn.php';
    
    $session = $_SESSION['User_ID'];
    if (empty($session)) {
        header("Location: login.php");
        exit();
    }

    function getOrderDetails($orderId){
        include '../../config/dbconn.php';
    
        $sql = "SELECT *
        FROM order_details
        JOIN product ON product.Product_ID = order_details.Product_ID
        JOIN size ON size.Size_ID = order_details.Size_ID
        WHERE order_details.Order_ID='$orderId'";
        $result = mysqli_query($dbconn, $sql);
        return $result;
    }
    
    function getOrders($userId){
        include '../../config/dbconn.php';
    
        $query = "SELECT * 
        FROM orders
        JOIN users on users.User_ID = orders.User_ID
        JOIN status on status.Status_ID = orders.Status_ID
        WHERE orders.User_ID ='$userId'
        ORDER BY orders.Order_Date DESC";
        $result = mysqli_query($dbconn, $query);
        return $result;
    }

    //get order/product based on name/id from database
    function getOrderSearch($search,$uId){
        include '../../config/dbconn.php';

        $query = "SELECT * 
        FROM orders
        JOIN status on status.Status_ID = orders.Status_ID
        JOIN users on users.User_ID = orders.User_ID
        JOIN order_details on order_details.Order_ID = orders.Order_ID
        JOIN product on product.Product_ID = order_details.Product_ID
        JOIN size on size.Size_ID = order_details.Size_ID
        WHERE users.User_ID = '$uId' AND (orders.Order_ID LIKE '%$search%' OR product.Product_Name LIKE '%$search%')";
        $result = mysqli_query($dbconn, $query);
        return $result;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Orders</title>
    <style>
        body{
            margin:0;
            background-color: #E6DAD1;
            font-family:calibri, sans-serif;
        }
        #bar{
            width: 100%;
            background-color: #C7D8CF;
            border-radius: 30px;
            color: #8AB49C;
            padding-left: 10px;
            padding-right: 10px;
        }
        table{
            margin-left: auto;
            margin-right: auto;
        }
        .searchbar{
            height: 20px;
            
        }  
        input[type="text"] {
            width: 100%;
            height: 40px;
            padding: 5px;
            border: 1px solid #C7D8CF;
            background-color: #C7D8CF;
            border-radius: 50px;
            box-sizing: border-box;
            margin-bottom: 5px;
            padding-left: 10px;
        } 
        .sIcon{
            background-color: #C7D8CF;
            border: 1px solid #C7D8CF;
        }
        .sIcon:hover {
            opacity: 0.8;
        }
        #three{
            width: 100%;
            padding: 10px;
            background-color:#8AB49C;
            border-radius: 40px;
            color: #E6DAD1;
        }
        #img{
            width: 100px;
            }
        #orderImg{
            width: 90px;
            height: 90px;
            padding: 10px;
            border-radius: 50%; 
            object-fit: cover; 
            overflow: hidden;
        }
        #list{
                border-spacing: 10px;
                padding-left: 50px;
                background-color:#8AB49C;
                width: 800px;   
                color: #E6DAD1;
                font-size: 20px;
                border-radius: 40px;
                border: 2px solid #8AB49C;
                text-align: left; 
            }
        /* #list{
            margin-left: auto;
            margin-right: auto;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-right: 50px;
            padding-left: 50px;
            background-color:#8AB49C;
            border-radius: 70px;   
            width: 70%;   
            text-align: left; 
            font-size: 20px;
            color: #E6DAD1;
        } */
        #header{
            width:100%;
            background-image: url('header bg pattern.png');
            background-repeat: repeat;
            background-size: contain;
            background-color: #846228;
            padding-left:10px;	
            font-size:30px;	
            color:#E6DAD1;
        }
        a{
            text-align: center;
            color: #E6DAD1;
            text-decoration: none;
        }
        a:hover{
            color: #DE8E04;
        }
        .user:hover {
            opacity: 0.8;
        }

        .user:hover + p {
            display: block;
        }
    </style>
</head>
<body>
<?php include 'customer header.php'; ?>
    <h1 style="text-align: center; color: #8AB49C;">SEARCH ORDER</h1>
    <form action="" method="POST">
        <table style="width: 800px; border-spacing: 5px;" border="0">
            <tr>
                <td>
                    <table id="bar" border="0">
                        <tr>
                            <td style="text-align: center;">
                                    <input type="text" name="query" placeholder="Insert order ID or product name" class="searchbar">
                            </td>
                            <td style="text-align: right;">
                                <button type="submit" name="submitOrder" class="sIcon" style="width: 22px; height: 22px; background: none; border: none; padding: 0; cursor: pointer;">
                                    <img src="search.png" alt="Submit" style="display: inline-block;">
                                </button>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </form>
    <br>
    <!-- SEARCH ORDER -->
    <?php
        if (isset($_POST['submitOrder'])) {
        
            $search = mysqli_real_escape_string($dbconn, $_POST['query']);

            if($search==""){
                echo "<script>alert('Enter query!'); 
                    window.location.href = 'order.php';
                    </script>";
                exit();
            }
            $result = getOrderSearch($search,$session);
            
            if ($result) { // Check if the query was successful
                $queryResult = mysqli_num_rows($result);
        
                if ($queryResult > 0) {
                    while ($rOrd = mysqli_fetch_assoc($result)) {
                        $shipPrice = 5;
    ?>
                        <tr>
                        <td colspan="2"> 
                        <table id="list" border="0">
                            <tr>
                                <td colspan="2">
                                    <b>ORDER ID:</b> <?php echo $rOrd['Order_ID'];?>
                                </td>
                                <td style="text-align: center;">
                                    <a href="../../pages/admin/receipt.php?orderId=<?php echo $rOrd['Order_ID'];?>" target="_blank" style="display: inline-block; padding: 7px 12px; background-color: white; color: #8AB49C; border-radius: 10px; font-size: 12px; border: none; cursor: pointer;">
                                        RECEIPT
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                <?php
                                    $orderDetails = getOrderDetails($rOrd['Order_ID']);
                                    $totPrice=0;

                                    if (mysqli_num_rows($orderDetails) > 0) {
                                        while ($rOrdDetails = mysqli_fetch_assoc($orderDetails)) {
                                            $itemTotalPrice = $rOrdDetails['Size_Price'] * $rOrdDetails['Quantity'];
                                            $totPrice += $itemTotalPrice;
                                ?>
                                    <table id="three" border="0">
                                        <tr>
                                            <td id="img" rowspan="2"><img src="<?php echo $rOrdDetails['Product_Image'];?>" id="orderImg"></td>
                                            <td id="name"><?php echo $rOrdDetails['Product_Name'];?></td>
                                            <td rowspan="2">x<?php echo $rOrdDetails['Quantity'];?></td>
                                            <td rowspan="2">RM<?php echo $rOrdDetails['Size_Price'];?></td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: text-top;">Size: <?php echo $rOrdDetails['Size_ID'];?></td>
                                        </tr>
                                    </table>
                                    <?php
                                        }
                                    }else {
                                        $detailsHtml .= '<tr><td colspan="4">No order details found.</td></tr>';
                                    }
                                ?>
                                </td>
                                <td rowspan="2">
                                    <b><?php if($rOrd['Status_Name']=='Pending') {
                                                echo 'Order Placed';
                                                }else echo $rOrd['Status_Name'];?></b><br>
                                    Total Payment<br>
                                    RM
                                    <?php 
                                        $orderTotalPrice = $totPrice + $shipPrice;
                                        echo number_format($orderTotalPrice, 2);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align: center;">
                                    <!-- link to specific product details -->
                                    <a href="status.php?orderId=<?php echo $rOrd['Order_ID'];?>">
                                        <b>view</b>
                                    </a> 
                                </td>
                            </tr>
                        </table>
                        </td>
                        </tr>
                        <br>
                        <?php exit();?>

    <?php
                    }
                } else {
                    echo "<br>";
                    echo "<center>There is no result matching your search!</center>";
                    exit();
                }
            } else {
                echo "Error: " . mysqli_error($dbconn); // Output the error message if the query fails
            }
        }else{
            $order = getOrders($session);
            if (mysqli_num_rows($order) > 0) {
                while ($rOrd = mysqli_fetch_assoc($order)) {
                    $shipPrice = 5;    
    ?>
    <tr>
    <td colspan="2"> 
    <table id="list" border="0">
        <tr>
            <td colspan="2">
                <b>ORDER ID:</b> <?php echo $rOrd['Order_ID'];?>
            </td>
            <td style="text-align: center;">
                <a href="../../pages/admin/receipt.php?orderId=<?php echo $rOrd['Order_ID'];?>" target="_blank" style="display: inline-block; padding: 7px 12px; background-color: white; color: #8AB49C; border-radius: 10px; font-size: 12px; border: none; cursor: pointer;">
                    RECEIPT
                </a>
            </td>
        </tr>
        <tr>
            <td colspan="2">
            <?php
                $orderDetails = getOrderDetails($rOrd['Order_ID']);
                $totPrice=0;

                if (mysqli_num_rows($orderDetails) > 0) {
                    while ($rOrdDetails = mysqli_fetch_assoc($orderDetails)) {
                        $itemTotalPrice = $rOrdDetails['Size_Price'] * $rOrdDetails['Quantity'];
                        $totPrice += $itemTotalPrice;
            ?>
                <table id="three" border="0">
                    <tr>
                        <td id="img" rowspan="2"><img src="<?php echo $rOrdDetails['Product_Image'];?>" id="orderImg"></td>
                        <td id="name"><?php echo $rOrdDetails['Product_Name'];?></td>
                        <td rowspan="2">x<?php echo $rOrdDetails['Quantity'];?></td>
                        <td rowspan="2">RM<?php echo $rOrdDetails['Size_Price'];?></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: text-top;">Size: <?php echo $rOrdDetails['Size_ID'];?></td>
                    </tr>
                </table>
                <?php
                    }
                }else {
                    $detailsHtml .= '<tr><td colspan="4">No order details found.</td></tr>';
                }
            ?>
            </td>
            <td rowspan="2">
                <b><?php if($rOrd['Status_Name']=='Pending') {
                            echo 'Order Placed';
                            }else echo $rOrd['Status_Name'];?></b><br>
                Total Payment<br>
                RM
                <?php 
                    $orderTotalPrice = $totPrice + $shipPrice;
                    echo number_format($orderTotalPrice, 2);
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center;">
                <!-- link to specific product details -->
                <a href="status.php?orderId=<?php echo $rOrd['Order_ID'];?>">
                    <b>view</b>
                </a> 
            </td>
        </tr>
    </table>
    </td>
    </tr>
    <br>
    <?php
                }
            }else {
                echo '<div style="text-align: center;margin-top: 5rem;margin-bottom: 5rem">';
                echo '<p>You have no order(s) been made yet!</p>';
                echo '<p>Back to <strong><a href="search product.php" style="color: orange">Products</a></strong></p>';
                echo '</div>';
            }
        }
    ?>
</body>
</html>