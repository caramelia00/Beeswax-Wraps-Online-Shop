<?php
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
        $oReceipt = $rOrder['Payment_Receipt'];
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
                width: 800px;
                height: 650px;
                background-color: #8AB49C;
                border-radius: 40px;
                border-spacing: 5px;
                padding: 5px;
                color: #E6DAD1;
                margin-left: auto;
                margin-right: auto;
            }
            #status, #payment_receipt{
                width: 390px;
                height: 100px;
                border: 1px solid #E6DAD1;
                border-radius: 30px;
                padding: 10px;
            }
            #summary, #delivery{
                width: 390px;
                height: 445px;
                border: 1px solid #E6DAD1;
                border-radius: 30px;
                padding: 10px;
                font-size: 24px;
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
            #save{
                margin-left: auto;
                margin-right: auto;
            }
            .sve{
                border-radius:15px;
                padding:5px;
                background-color: #e6dad1;
                color: #846228;
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
                font-family:calibri, sans-serif;
                background-color: #E6DAD1;   
                margin: 0;
				padding: 0;
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
                background-color: #8AB49C;
                border: 1px solid #8AB49C;
				color: #E6DAD1;
                font-size: 24px;
				text-decoration: none;
			}
			button:hover{
				color: #5e7b6a;
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
    <?php include 'admin header.php'; ?>
		</table>
		<br><br>
        <form action="update order process.php" method="POST">
            <table id="one" border="0">
                <tr>
                    <td>
                        <table id="status" border="0">
                            <tr>
                                <th style="font-size: 30px; text-align: center;">STATUS</th>
                            </tr>
                            <tr>
                                <td style="text-align: center;">
                                <input type="hidden" name="orderId" value="<?php echo $oStatus; ?>">
                                <select name="newStatus" class="mySelect">
                                    <option value="S01"<?php echo ($oStatus == 'S01' ? ' selected' : ''); ?>>Pending</option>
                                    <option value="S02"<?php echo ($oStatus == 'S02' ? ' selected' : ''); ?>>Preparing to ship</option>
                                    <option value="S03"<?php echo ($oStatus == 'S03' ? ' selected' : ''); ?>>Out for delivery</option>
                                    <option value="S04"<?php echo ($oStatus == 'S04' ? ' selected' : ''); ?>>Completed</option>
                                    <!--<option value="S05"<?php //echo ($pStatus == 'S05' ? ' selected' : ''); ?>>Failed</option>-->
                                </select>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td>
                    <table id="payment_receipt" border="0">
                        <tr>
                            <th style="font-size: 30px; text-align: center;">PAYMENT RECEIPT</th>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                <a href="<?php echo $oReceipt; ?>" target="_blank" style="display: inline-block; padding: 7px 12px; background-color: white; color: #8AB49C; border-radius: 10px; font-size: 12px; border: none; cursor: pointer;">
                                    VIEW
                                </a>
                            </td>
                        </tr>
                    </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table id="summary" border="0">
                            <tr>
                                <th colspan="3" style="font-size: 30px;">
                                    ORDER SUMMARY
                                </th>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    ITEMS ORDERED
                                </td>
                            </tr>

                            <?php 
                                $orderDetails = getOrderDetails($oId);
                                $detailsHtml = '';
                                $totPrice=0;
                            
                                if (mysqli_num_rows($orderDetails) > 0) {
                                    while ($rOrdDetails = mysqli_fetch_assoc($orderDetails)) {
                                        $itemTotalPrice = $rOrdDetails['Size_Price'] * $rOrdDetails['Quantity'];
                                        $totPrice += $itemTotalPrice;
                                        $detailsHtml .= '
                                        <tr>
                                        <td rowspan="3">
                                            <img src="' . $rOrdDetails['Product_Image'] . '" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; overflow: hidden;">
                                        </td>
                                        <td colspan="2">
                                            ' . htmlspecialchars($rOrdDetails['Product_Name']) . '
                                        </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                Size: ' . htmlspecialchars($rOrdDetails['Size_ID']) . '
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                X' . htmlspecialchars($rOrdDetails['Quantity']) . '
                                            </td>
                                            <td style="text-align: right;">
                                                RM' . number_format(htmlspecialchars($rOrdDetails['Size_Price']), 2) . '
                                            </td>
                                        </tr>
                                        ';
                                    }
                                } else {
                                    $detailsHtml .= '<tr><td colspan="4">No order details found.</td></tr>';
                                }
                                echo $detailsHtml
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
                                <th colspan="2" style="font-size: 30px;">
                                    DELIVERY DETAILS
                                </th>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    FULL NAME<br>
                                    <?php echo $uFullName; ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    ADDRESS<br>
                                    <?php echo $uAddress1; ?>,<br>
                                    <?php if($uAddress2 != 'NULL') echo $uAddress2 . ',<br>'; ?>
                                    <?php echo $postcode; ?> <?php echo $city; ?>, <br>
                                    <?php echo $state; ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    ORDER ID <br>
                                    <input type="hidden" name="oId" value="<?php echo $oId; ?>">
                                    <?php echo $oId; ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table id="save" border="0">
                            <tr>
                                <td>
                                    <button type="submit" name="update" class="sve" style="cursor: pointer;">SAVE CHANGES</button>
                                </td>
                            </tr>
                    </td>
                </tr>
            </table>
        </form>
	</body>
</html>
