<?php 
	include '../../config/dbconn.php';
	session_start();
	## verify if the session user is admin
	if(isset($_SESSION['username']) && $_SESSION['username'] == "Administrator"){
?>

<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
	<title>Hive4</title>
	<head>
		<style>
            body{
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
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
            #orderid{
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
                font-size: 28px;
				text-decoration: none;
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
	<table id=header  border="0">
		<tr>
			<th style="padding-left: 20px;">
				<a href="admin users list.php">
					USERS
				</a>
			</th>
			<th>
				<a href="admin product list.php">
					PRODUCTS
				</a>
			</th>
			<th>
				<a href="admin orders.php">
				ORDERS
				</a>
			</th>
			<td colspan=2><img src="design 1.png"  style="width:60px; height:60px;"></td>
			<th style="padding-left:60px;">
				<a href="admin dashboard.php">
					DASHBOARD
				</a>
			</th>
			<td>
				<a href="admin view account.php">
					<img src="user.png" style="width:71px; height:40px;" class="user">
				</a>
			</td>
		</tr>
	</table>
	<br><br>
	<h1 style="text-align: center; color: #8AB49C;">SEARCH ORDER</h1>
    <table id="one" style=" border-spacing: 5px;" border="0">
        <tr>
            <td>
                <table id="bar" border="0">
                    <form action="search.php" method="get">
                        <tr>
                            <td style="text-align: center;">
                                    <input type="text" name="query" placeholder="Insert product name" class="searchbar">
                            </td>
                            <td style="text-align: right;">
                                <button type="submit" class="sIcon"><img src="search.png" style="width: 22px; height: 22px;"></button>
                            </td>
                        </tr>
                    </form>
                </table>
            </td>
            <td style="width: 183px;">
                <a href="admin order invoice.php">
                    <img src="invoice.png">
                </a>
            </td>
        </tr>
                    <?php getOrders(); ?>
    </table>
    <javascript>
        <!-- function deleteOrder(orderId) {
            // Here you can perform the logic to delete the order with the given orderId
            console.log('Deleting order with ID:', orderId);
            // Add your delete logic here, such as making an API call or updating the database
        } -->
    </javascript>
    
</html>
<?php
} 
Else
{	## if the session username is no admin, redirect the page to the login page 
header("Location: admin login.php");
}

include '../../config/dbconn.php';

//get order details from database
function getOrderDetails($orderId){
    include '../../config/dbconn.php';

    $sql = "SELECT order_details.Order_Details_ID, order_details.Quantity, order_details.Product_ID, order_details.Size_ID, product.Product_Name, product.Product_Image, product_size.Size_ID, product_size.Size_Price
	FROM order_details
	JOIN product ON product.Product_ID = order_details.Product_ID
	JOIN product_size ON product_size.Size_ID = order_details.Size_ID
    WHERE order_details.Order_ID='$orderId'";
	$result = mysqli_query($dbconn, $sql);
	return $result;
}

//--- get orders from database ---
function getOrders(){
    include '../../config/dbconn.php';

    $query = "SELECT orders.Order_ID, orders.Order_Date, orders.Order_Price, status.Status_Name 
    FROM orders
    JOIN status on status.Status_ID = orders.Status_ID
    ORDER BY orders.Order_Date DESC;
    ";
    $result = mysqli_query($dbconn, $query);

    if(mysqli_num_rows($result) > 0){

        while($rOrd = mysqli_fetch_assoc($result)){
            $result1=getOrderDetails($rOrd['Order_ID']);
                echo "
                <tr>
                    <td colspan='2'><table id='orderid' border='1'>
                        <tr>
                            <td style='width: 150px; padding-left: 10px;'>Order ID:</td>
                            <td>" . $rOrd['Order_ID'] . "</td>
                        </tr>
                        <tr>
                            ";

            while($rOrdDetails = mysqli_fetch_assoc($result1)){
                echo " 
                            <td colspan='2'> 
                            <table id='order_details' border='0'>
                                <tr>
                                    <td id='img' rowspan='2'><img src='" . $rOrdDetails['Product_Image'] . "' style='width: 100px;'></td>
                                    <td id='name'>" . $rOrdDetails['Product_Name'] . "</td>
                                    <td rowspan='2'>x" . $rOrdDetails['Quantity'] . "</td>
                                    <td rowspan='2'>RM" . $rOrdDetails['Size_Price'] . "</td>
                                </tr>
                                <tr>
                                    <td style='vertical-align: text-top;'>Size:" . $rOrdDetails['Size_ID'] . "</td>
                                </tr>
                            </table>
                            </td>";
            }
            echo "
                            <td rowspan='2'>
                                <b>" . $rOrd['Status_Name'] . "</b>
                                <br>Total Payment
                                <br>RM" . $rOrd['Order_Price'] . "
                            </td>
                        </tr>
                        <tr>
                            <td colspan='2'>
                                <table id='five' border='0'>
                                    <tr>
                                        <td style='padding-bottom: 4px;'>
                                            <a id='button' href='admin order details.php'>
                                                <b>VIEW</b>
                                            </a>                                        
                                        </td>
                                        <td>
                                            <button onclick=\"deleteOrder('" . $rOrd['Order_ID'] . "')\">
                                                <b>DELETE</b>
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No orders found.</td></tr>";
    }
}

//--- search for orders by ID ---
function searchOrder($order_id){
    $query = "SELECT * FROM orders WHERE order_id = '$order_id'";
    $result = mysqli_query($dbconn, $query);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){

            //displayOrder($row);

            echo "<tr>";
            echo "<td>" . $row['order_id'] . "</td>";
            echo "<td><img src='" . $row['product_picture'] . "' style='width: 100px;'></td>";
            echo "<td>" . $row['product_name'] . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "<td>RM " . $row['product_price'] . "</td>";
            echo "<td>RM " . $row['total_price'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No orders found.</td></tr>";
    }
}

//--- display order ---
function displayOrder($row){
    $element='
    <tr>
        <td colspan="2">
            <table id="three" border="0">
                <tr>
                    <td colspan="2">
                        <table id="orderid" border="0">
                            <tr>
                                <td style="width: 150px; padding-left: 10px;">
                                    Order ID:
                                </td>
                                <td>'.$row['Order_ID'].'</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>

                    <td>
                        <table id="four" border="0">
                            <tr>
                                <td id="img" rowspan="2"><img src="'.$row['Product_Image'].'"></td>
                                <td id="name">'.$row['Product_Name'].'</td>
                                <td rowspan="2">x'.$row['Quantity'].'</td>
                                <td rowspan="2">RM'.$row['Size_Price'].'</td>
                            </tr>
                            <tr>
                                <td style="vertical-align: text-top;">Size:'.$row['Size_ID'].'</td>
                            </tr>
                        </table>
                    </td>

                    <td rowspan="2">
                        <b>UNPAID</b>
                        <br>Total Payment
                        <br>RM'.$row['Order_Price'].'
                    </td>
                </tr>

                //--------if ada prod lagi,

                <tr>

                    <td>
                        <table id="four" border="0">
                            <tr>
                                <td id="img" rowspan="2"><img src="dried.png"></td>
                                <td id="name">Dried Caesalpinia Flower Beeswax Wraps</td>
                                <td rowspan="2">x1</td>
                                <td rowspan="2">RM20.00</td>
                            </tr>
                            <tr>
                                <td style="vertical-align: text-top;">Size:M</td>
                            </tr>
                        </table>
                    </td>

                </tr>

                <tr>
                    <td colspan="2">
                        <table id="five" border="0">
                            <tr>
                                <td style="padding-bottom: 4px;">
                                    <a id="button" href="admin order details.php">
                                        <b>VIEW</b>
                                    </a>                                        
                                </td>
                                <td>
                                    <span id="orderId"></span>
                                    <button onclick="deleteOrder(orderId)">
                                        <b>
                                            DELETE
                                        </b>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    ';
    echo $element;
}
?>