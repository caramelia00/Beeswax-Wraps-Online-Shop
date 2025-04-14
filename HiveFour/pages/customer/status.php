<?php
session_start();
include '../../config/dbconn.php';

if (isset($_GET['orderId'])) {
    $updateOrderId = $_GET['orderId'];

    $order = getOrders($updateOrderId);
    $rowOrder = mysqli_num_rows($order);

    if ($rowOrder == 0) {
        echo "No record found";
    } else {
        $rOrder = mysqli_fetch_assoc($order);

        $oId = $rOrder['Order_ID'];
        $oStatus = $rOrder['Status_ID'];
        $uFullName = $rOrder['User_Full_Name'];
        $uAddress1 = $rOrder['Address1'];
        $uAddress2 = $rOrder['Address2'];
        $postcode = $rOrder['Postcode'];
        $state = $rOrder['State'];
        $city = $rOrder['City'];
    }
}

function getOrders($orderId)
{
    global $dbconn;
    $sql = "SELECT *
            FROM orders
            JOIN order_details on order_details.Order_ID = orders.Order_ID
            JOIN status on status.Status_ID = orders.Status_ID
            JOIN users on users.User_ID = orders.User_ID
            JOIN user_details on user_details.User_ID = users.User_ID
            WHERE orders.Order_ID='$orderId'";
    $result = mysqli_query($dbconn, $sql);
    return $result;
}

function getOrderDetails($orderId){
    global $dbconn;
    $sql = "SELECT *
            FROM order_details
            JOIN orders on orders.Order_ID = order_details.Order_ID
            JOIN product on product.Product_ID = order_details.Product_ID
            JOIN size on size.Size_ID = order_details.Size_ID
            WHERE orders.Order_ID='$orderId'";
    $result = mysqli_query($dbconn, $sql);
    return $result;
}
?>
<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
	<title>Order Details</title>
	<head>
		<style>
            #one{
                width: 80%;
                background-color: #E6DAD1;
                border-radius: 40px;
                border-spacing: 5px;
                padding: 5px;
                color: #8AB49C;
                margin-left: auto;
                margin-right: auto;
            }
            #status{
                width: 100%;
                border: 1px solid #8AB49C;
                border-radius: 30px;
                padding: 10px;
                padding-left: 40px;
            }
            #summary, #delivery{
                width: 100%;
                height: 310px;
                border: 1px solid #8AB49C;
                border-radius: 30px;
                padding: 10px;
                padding-left: 40px;
            }
            .mySelect{
                background-color: #C7D8CF;
                border: 1px solid #C7D8CF;
                color: #846228;
            }
            #startDateButton, #endDateButton{
                height: 40px;  
                width: 40px;
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
            body{
                margin:0;
                font-family:calibri, sans-serif;
                background-color: #8AB49C;   
            }
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
            button{
				text-align: center;
                background-color: white;
                border: 1px solid #E6DAD1;
				color: #8AB49C;
                font-size: 12px;
                font-weight: bold;
				text-decoration: none;
                border-radius: 40px;
                padding: 10px;
			}
			button:hover{
				background-color: #E6DAD1;
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
		<br><br>
        <table id="one">
            <tr>
                <td colspan="2">
                    <table id="status" border="0">
                        <tr>
                            <td colspan="4" style="font-size: 30px; text-align: left;">STATUS</td>
                        </tr>
                        <tr>
                            <td><b>Order placed</b></td>
                            <td><b>Preparing to ship</b></td>
                            <td><b>Out for delivery</b></td>
                            <td><b>Completed</b></td>
                        </tr>
                        <tr>
                            <?php
                            if($oStatus=="S01"){
                                echo '<td><img src="done.png" width="40px" height="40px"></td>
                                    <td><img src="default.png" width="40px" height="40px"></td>
                                    <td><img src="default.png" width="40px" height="40px"></td>
                                    <td><img src="default.png" width="40px" height="40px"></td>
                                ';
                            }else if($oStatus=="S02"){
                                echo '<td><img src="done.png" width="40px" height="40px"></td>
                                    <td><img src="done.png" width="40px" height="40px"></td>
                                    <td><img src="default.png" width="40px" height="40px"></td>
                                    <td><img src="default.png" width="40px" height="40px"></td>
                                ';
                            }else if($oStatus=="S03"){
                                echo '<td><img src="done.png" width="40px" height="40px"></td>
                                    <td><img src="done.png" width="40px" height="40px"></td>
                                    <td><img src="done.png" width="40px" height="40px"></td>
                                    <td><img src="default.png" width="40px" height="40px"></td>
                                ';
                            }else if($oStatus=="S04"){
                                echo '<td><img src="done.png" width="40px" height="40px"></td>
                                    <td><img src="done.png" width="40px" height="40px"></td>
                                    <td><img src="done.png" width="40px" height="40px"></td>
                                    <td><img src="done.png" width="40px" height="40px"></td>
                                ';
                            }
                            ?>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table id="summary" border="0">
                        <tr>
                            <td colspan="3" style="font-size: 30px;">
                                ORDER SUMMARY
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                ITEMS ORDERED
                            </td>
                        </tr>

                        <?php 
                                $orderDetails = getOrderDetails($oId);
                                $totPrice=0;
                            
                                if (mysqli_num_rows($orderDetails) > 0) {
                                    while ($rOrdDetails = mysqli_fetch_assoc($orderDetails)) {
                                        $itemTotalPrice = $rOrdDetails['Size_Price'] * $rOrdDetails['Quantity'];
                                        $totPrice += $itemTotalPrice;
                        ?>
                                        <tr>
                                            <td rowspan="3">
                                                <img src="<?php echo $rOrdDetails['Product_Image'];?>" style="width: 90px; height: 90px; border-radius: 50%; object-fit: cover; overflow: hidden;">
                                            </td>
                                            <td colspan="2">
                                                <?php echo $rOrdDetails['Product_Name'];?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                Size: <?php echo $rOrdDetails['Size_ID'];?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                X<?php echo $rOrdDetails['Quantity'];?>
                                            </td>
                                            <td style="text-align: right;">
                                                RM<?php echo $rOrdDetails['Size_Price'];?>
                                            </td>
                                        </tr>
                        <?php
                                }
                            }
                        ?>
                        <tr>
                            <td>
                                Items Subtotal
                            </td>
                            <td colspan="2">
                                RM<?php echo number_format($totPrice, 2); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Shipping Fee
                            </td>
                            <td colspan="2">
                                RM5.00
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Total Payment
                            </td>
                            <td colspan="2" style="font-size: 30px;">
                                RM<?php echo number_format(($totPrice + 5), 2);?>
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table id="delivery" border="0">
                        <tr>
                            <td colspan="2" style="font-size: 30px;">
                                DELIVERY DETAILS
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                FULL NAME <br>
                                <?php echo $uFullName; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                ADDRESS <br>
                                <?php echo $uAddress1; ?>,<br>
                                    <?php if($uAddress2 != 'NULL') echo $uAddress2 . ',<br>'; ?>
                                    <?php echo $postcode; ?> <?php echo $city; ?>, <br>
                                    <?php echo $state; 
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                ORDER ID <br>
                                <?php echo $oId; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
	</body>
</html>
	
	
	