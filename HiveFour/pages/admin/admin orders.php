<?php 
	include '../../config/dbconn.php';
	session_start();
	// Verify if the session user is admin
	if(isset($_SESSION['username']) && $_SESSION['username'] == "Administrator"){
?>

<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
	<title>Orders</title>
	<head>
		<style>
            body{
                font-family:calibri, sans-serif;
                background-color: #E6DAD1;
                margin: 0;
				padding: 0;
            }
            #one{
                width: 800px;
                font: 24px;
            }
            #bar{
                width: 100%;
                background-color: #C7D8CF;
                border-radius: 30px;
                color: #8AB49C;
                padding-left: 10px;
                padding-right: 10px;
                margin-left: auto;
                margin-right: auto;
            }
            #three{
                width: 100%;
                padding: 10px;
                background-color:#8AB49C;
                border-radius: 40px;
                color: #E6DAD1;
            }
            .order-container {
                width: 100%;
                color: #E6DAD1;
                font-size: 20px;
                border-radius: 40px;
                border: 2px solid #8AB49C;
                padding: 10px;
                margin-bottom: 20px;
                background-color: #8AB49C;
            }
            #orderid, #order_details{
                width: 100%;
                color:#E6DAD1;
                font-size: 24px;
            }
            #four{
                width: 100%;
                margin-left: 0px;
                color: #E6DAD1;
            }
            #five{
                margin-left: auto;
                margin-right: auto;
            }
            #img{
                width: 100px;
            }
            #name{
                width: 400px;
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
                text-align: right;
            }
            .sIcon:hover {
                opacity: 0.8;
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
            table{
                margin-left: auto;
                margin-right: auto;
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
            #button{
				text-align: center;
                background-color: #8AB49C;
                border: 1px solid #8AB49C;
				color: #E6DAD1;
                font-size: 24px;
				text-decoration: none;
                cursor: pointer;
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
        <script>
        function confirmDeletion(orderId) {
            var userConfirmation = confirm("Are you sure you want to delete this order?");
            if (userConfirmation) {
                window.location.href = 'delete order process.php?orderId=' + orderId;
            }
        }
        </script>

	</head>
    <body>
    <?php include 'admin header.php'; ?>

	<h1 style="text-align: center; color: #8AB49C;">SEARCH ORDER</h1>
    <table id="one" style="border-spacing: 5px;" border="0">
        <tr>
            <td>
                <table id="bar" border="0">
                    <form action="search.php" method="POST">
                        <tr>
                            <td style="text-align: center;">
                                <input type="text" name="query" placeholder="Insert order ID, order status, customer name, product name" class="searchbar">
                            </td>
                            <td style="text-align: right;">
                                <button type="submit" name="submitOrder" class="sIcon" style="width: 22px; height: 22px; background: none; border: none; padding: 0; cursor: pointer;">
                                    <img src="search.png" alt="Submit" style="display: inline-block;">
                                </button>
                            </td>
                        </tr>
                    </form>
                </table>
            </td>
        </tr>
    </table>
    <?php displayOrders(); ?>
</body>
</html>
<?php
} 
else {
    // If the session username is not admin, redirect the page to the login page 
    header("Location: ../../pages/customer/login.php");
    exit;
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

function getOrders(){
    include '../../config/dbconn.php';

    $query = "SELECT * 
    FROM orders
    JOIN status on status.Status_ID = orders.Status_ID
    WHERE orders.Payment_Receipt <> ''
    ORDER BY orders.Order_Date DESC";
    $result = mysqli_query($dbconn, $query);
    return $result;
}

function generateOrderDetailsHtml($orderId) {
    $orderDetails = getOrderDetails($orderId);
    $detailsHtml = '';
    $totPrice=0;

    if (mysqli_num_rows($orderDetails) > 0) {
        while ($rOrdDetails = mysqli_fetch_assoc($orderDetails)) {
            $itemTotalPrice = $rOrdDetails['Size_Price'] * $rOrdDetails['Quantity'];
            $totPrice += $itemTotalPrice;
            $detailsHtml .= '
            <table id="three" border="0">
                <tr>
                    <td id="img" rowspan="2"><img src="' . htmlspecialchars($rOrdDetails['Product_Image']) . '" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; overflow: hidden;"></td>
                    <td id="name">' . htmlspecialchars($rOrdDetails['Product_Name']) . '</td>
                    <td rowspan="2">x' . htmlspecialchars($rOrdDetails['Quantity']) . '</td>
                    <td rowspan="2">RM' . htmlspecialchars($rOrdDetails['Size_Price']) . '</td>
                </tr>
                <tr>
                    <td style="vertical-align: text-top;">Size: ' . htmlspecialchars($rOrdDetails['Size_ID']) . '</td>
                </tr>
            </table>';
        }
    } else {
        $detailsHtml .= '<tr><td colspan="4">No order details found.</td></tr>';
    }

    return ['html' => $detailsHtml, 'total_price' => $totPrice];
}

function displayOrders() {
    $order = getOrders();
    if (mysqli_num_rows($order) > 0) {
        while ($rOrd = mysqli_fetch_assoc($order)) {
            $orderDetails = generateOrderDetailsHtml($rOrd['Order_ID']);
            $orderDetailsHtml = $orderDetails['html'];
            $shipPrice = 5;
            $orderTotalPrice = $orderDetails['total_price'] + $shipPrice;
            echo '
            <br>
            <tr>
                <td colspan="2">
                    <table id="list" border=0">
                        <tr>
                            <td colspan="2" style="width: 150px; padding-left: 10px;"><b>Order ID:</b> ' . htmlspecialchars($rOrd['Order_ID']) . '</td>
                            <td style="text-align: center;">
                                <a href="receipt.php?orderId=' . htmlspecialchars($rOrd['Order_ID']) . '" target="_blank" style="display: inline-block; padding: 7px 12px; background-color: white; color: #8AB49C; border-radius: 10px; font-size: 12px; border: none; cursor: pointer;">
                                    RECEIPT
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">' . $orderDetailsHtml . '</td>
                            <td rowspan="2">
                                <b>' . htmlspecialchars($rOrd['Status_Name']) . '</b><br>
                                Total Payment<br>
                                RM' . number_format($orderTotalPrice, 2) . '
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <table id="five" border="0">
                                    <tr>
                                        <td style="padding-bottom: 4px;">
                                            <a id=button href="admin order details.php?orderId=' . htmlspecialchars($rOrd['Order_ID']) . '">
                                                <b>VIEW</b>
                                            </a>                                        
                                        </td>
                                        <td style="padding-bottom: 4px;">
                                        <button onclick="confirmDeletion(\'' . htmlspecialchars($rOrd['Order_ID']) . '\')" id="button">
                                            <b>DELETE</b>
                                        </button>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>';
        }
    } else {
        echo '<tr><td colspan="7">No orders found.</td></tr>';
    }
}
?>

