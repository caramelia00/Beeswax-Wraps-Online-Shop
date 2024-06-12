<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Hive4 Order</title>
    <style>
        body{
            margin:0;
        }
        body{
            background-color: #E6DAD1;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
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
        #list{
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
        .user:hover {
            opacity: 0.8;
        }

        .user:hover + p {
            display: block;
        }
    </style>
</head>
<body>
	<table id=header  border="0">
		<tr>
			<th style="padding-left: 20px;">
				<a href="HOME.php">
					HOME
				</a>
			</th>
			<th>
				<a href="search product.php">
					PRODUCTS
				</a>
			</th>
			<th>
				<a href="About Us.php">
				ABOUT US
				</a>
			</th>
			<td colspan=2><img src="design 1.png"  style="width:80px; height:80px; padding-right: 30px;"></td>
			<td>
				<a href="order.php">
					<img src="order.png" style="width: 50px;height: 50px;" class="user">
				</a>
			</td>
			<td>
				<a href="cart.php">
					<img src="cart.png" style="width: 50px;height: 50px;" class="user">
				</a>
			</td>
			<td>
				<a href="VIEW ACCOUNT DETAILS.php">
					<img src="user.png" style="width:71px; height:40px;" class="user">
				</a>
			</td>
		</tr>
	</table>
    <br>
    <form action="search.php" method="get">
        <table style="width: 800px; border-spacing: 5px;" border="0">
            <tr>
                <td>
                    <table id="bar" border="0">
                        <tr>
                            <td style="text-align: center;">
                                    <input type="text" name="query" placeholder="Insert order ID" class="searchbar">
                            </td>
                            <td style="text-align: right;">
                                <button type="submit" class="sIcon"><img src="search.png" style="width: 22px; height: 22px;"></button>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </form>
    <br> 
</body>
</html>
<?php
        $result = getOrders();
        while ($row = mysqli_fetch_assoc($result)) {
        displayOrders($row['Order_ID'], $row['Order_Date'], $row['Order_Time'], $row['Status_ID'], $row['User_ID'], $row['Payment_Receipt']);
        }
    ?>
</body>
</html>
<?php
    function getOrders(){
        include '../../config/dbconn.php';
      
        $sql = "SELECT *
        FROM orders";
        $result = mysqli_query($dbconn, $sql);
        return $result;
    }
    function displayOrders($orderId, $orderStatus, $orderPrice, $orderTotalPrice, $orderDetailsHtml) {
        echo '
        <br>
        <tr>
            <td colspan="2">
                <table id="list" border="1">
                    <tr>
                        <td style="width: 150px; padding-left: 10px;">Order ID:</td>
                        <td>' . htmlspecialchars($orderId) . '</td>
                    </tr>
                    <tr>
                        <td colspan="2">' . $orderDetailsHtml . '</td>
                        <td rowspan="2">
                            <b>' . htmlspecialchars($orderStatus) . '</b><br>
                            Total Payment<br>
                            RM' . htmlspecialchars($orderTotalPrice) . '
                        </td>
                        <td rowspan=2 style="width:120px; padding-left: 25px;">
                            <a id=button href="admin order details.php' . htmlspecialchars($orderId) . '">
                                <b>VIEW</b>
                            </a>                                        
                        </td>
                    </tr>
                </table>
            </td>
        </tr>';
        
    }
    if(isset($_POST['submitProduct'])) {
        displayProductSearchBar();

        $search = mysqli_real_escape_string($dbconn, $_POST['query']);
        $result = getProduct($search);
        $queryResult = mysqli_num_rows($result);

        if($queryResult > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                displayProduct($row['Product_Name'], $row['Product_Image'], $row['Product_Status_ID'], $row['Product_ID']);
            }
        }
        else {
        echo "<br>";
        echo "<center>There is no result matching your search!</center>";
        }
    } //--- ORDER ---
    else if (isset($_POST['submitOrder'])) {
        displayOrderSearchBar();
    
        $search = mysqli_real_escape_string($dbconn, $_POST['query']);
        $result = getOrders($search);
        
        if ($result) { // Check if the query was successful
            $queryResult = mysqli_num_rows($result);
    
            if ($queryResult > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $orderDetails = generateOrderDetailsHtml($row['Order_ID']);
                    $orderDetailsHtml = $orderDetails['html'];
                    $shipPrice = 5;
                    $orderTotalPrice = $orderDetails['total_price'] + $shipPrice;
    
                    displayOrders($row['Order_ID'], $row['Status_Name'], $row['Size_Price'], $orderTotalPrice, $orderDetailsHtml);
                }
            } else {
                echo "<br>";
                echo "<center>There is no result matching your search!</center>";
            }
        } else {
            echo "Error: " . mysqli_error($dbconn); // Output the error message if the query fails
        }
    } 

?>
