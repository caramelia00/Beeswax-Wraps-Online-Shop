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
	<title>Dashboard</title>
	<head>
		<style>
        body{
            background-color: #E6DAD1;
            font-family:calibri, sans-serif;
            margin: 0;
			padding: 0;
        }
			#top{
				width: 1120px;
				margin-left:auto;
				margin-right:auto;
				/* padding-top:20px; */
				border-spacing:15px;
			}
			#two{
				margin-left:auto;
				margin-right:auto;
				background-color:#8AB49C;
				border-radius:25px;
				border-right:4px;
				padding:42px;
			}
			#low{
				width: 1120px;
				margin-left:auto;
				margin-right:auto;
				border-spacing:15px;
			}
			.listord,.listusr{
				margin-left:auto;
				margin-right:auto;
				background-color:#8AB49C;
				border-radius:25px;
				padding:15px;
				padding-right:20px;
				height:500px;
			}
			#four{
				margin-left:auto;
				margin-right:auto;			
				background-color:#8AB49C;
				border-radius:25px;
				padding:15px;
				padding-right:20px;
			}
			#ord{
				border-collapse:collapse;
				border-style:solid;
				border:3px;
				border-color:#E6DAD1;
				border: 1px solid #E6DAD1;
				padding:20px;
				text-align: left;
				max-width:720px;
				white-space: normal;
				/* Allow text wrapping */
				overflow: hidden;
				/* Hides overflow */
				text-overflow: ellipsis;
				/* Adds ellipsis for overflow */
			}
			#headuser{
				margin-left:auto;
				margin-right:auto;
				background-color:#8AB49C;
				border-radius:25px;
				padding:15px;
				
			}
			
			table{
				font-family:calibri, sans-serif;
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
			#head{
				text-align: center;
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
	<?php include 'admin header.php'; ?>
	<body>
	<table id=top border="0">
		<tr>
			<td>
				<table id=two border="0">
					<tr>
						<td  style="font-size:30px;">
						<?php

						require '../../config/dbconn.php';
						$sql = "SELECT COUNT(User_ID) FROM users WHERE Type_ID = 'UT01'";
						$result = mysqli_query($dbconn,$sql);
						$row = mysqli_fetch_array($result);
						echo $row[0];

						?>
						</td>
						<td rowspan=2 style="padding-left:20px;"><img src="customer.png"></td>
					</tr>
					<tr>
						<td >Customers</td>
					</tr>
				</table>
			</td>
			<td>
				<table id=two border="0">
					<tr>
						<td  style="font-size:30px;">
						<?php
							
						require '../../config/dbconn.php';
						$sql = "SELECT COUNT(Order_ID) FROM orders WHERE orders.Payment_Receipt <> ''";
						$result = mysqli_query($dbconn,$sql);
						$row = mysqli_fetch_array($result);
						echo $row[0];

						?>
						</td>
						<td rowspan=2 style="padding-left:20px;"><img src="orders.png"></td>
					</tr>
					<tr>
						<td>Orders</td>
					</tr>
				</table>
			</td>
			<td>
				<table id=two border="0">
					<tr>
						<td  style="font-size:30px;">
						<?php
                
						require '../../config/dbconn.php';
						$sql = "SELECT COUNT(Product_ID) FROM product";
						$result = mysqli_query($dbconn,$sql);
						$row = mysqli_fetch_array($result);
						echo $row[0];
		
						?>
						</td>
						<td rowspan=2 style="padding-left:20px;"><img src="products.png"></td>
					</tr>
					<tr>
						<td>Products</td>
					</tr>
				</table>
			</td>
			<td>
				<table id=two border="0">
					<tr>
						<td  style="font-size:30px;">
						<?php
                
						require '../../config/dbconn.php';
						$sql = "
						SELECT SUM(size.Size_Price * order_details.Quantity) AS total_sales
						FROM orders
						JOIN order_details ON order_details.Order_ID = orders.Order_ID
						JOIN size ON size.Size_ID = order_details.Size_ID
						WHERE orders.Payment_Receipt <> ''
						";

						$result = mysqli_query($dbconn, $sql);
						if ($result) {
							$row = mysqli_fetch_assoc($result);
							echo 'RM ' . number_format($row['total_sales'], 2);
						} else {
							echo "Error: " . mysqli_error($dbconn);
						}
		
						?>
						</td>
						<td rowspan=2 style="padding-left:20px;"><img src="income.png"></td>
					</tr>
					<tr>
						<td>Income</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table id=low border="0">
		<tr>
			<td colspan=3>
				<table class = listord border="0">
					<tr>
						<td style="text-align:left; font-size:40px; height: 50px;"><b>RECENT ORDERS</b></th>
						<td style="text-align:right;">
							<a href="admin orders.php">
								<img src="see all.png">
							</a>
						</td>
					</tr>
					<tr>
						<td colspan=2 style="vertical-align: top;">
							<table id=ord border="1">
								<tr>
									<td style="padding-right:20px; padding: 15px; border-width:2px;">Order ID</td>
									<td style="padding-right:20px; padding: 15px; border-width:2px;">Products</td>
									<td style="padding-right:20px; padding: 15px; border-width:2px;">Size</td>
									<td style="padding-right:20px; padding: 15px; border-width:2px;">Qty</td>
									<td style="padding-right:20px; padding: 15px; border-width:2px;">Customer</td>
									<td style="padding-right:20px; padding: 15px; border-width:2px;">Status</td>
								</tr>
								<?php

								$result = getOrdersDashboard();
								while ($row = mysqli_fetch_assoc($result)) {
								dispOrdersDashboard($row['Order_ID'],$row['Product_Name'],$row['Size_ID'],$row['Quantity'],$row['User_Name'],$row['Status_Name']);
								}
							
								?>
							</table>
						</td>
					</tr>

				</table>
			</td>
			<td colspan=3>
				<table class= listusr border="0">
					<tr>
						<td style="text-align:left; font-size:40px; height: 50px;"><b>USERS</b></th>
						<td style="text-align:right;">
							<a href="admin users list.php">
								<img src="see all.png">
							</a> 
						</td>
					</tr>
					<tr>
						<td colspan=2 style="vertical-align: top;">
							<table  border="0">
								<tr>
									<td>
										<table border="0">
											<?php

											$result = getUsersDetailsDashboard();
											while ($row = mysqli_fetch_assoc($result)) {
												users($row['User_Name'], $row['Profile_Pic'], $row['User_Email']);
											}
									
											?>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>

				</table>
			</td>
			
		</tr>
	</table>
</body>
</html>

<?php
} 
Else
{	## if the session username is no admin, redirect the page to the login page 
header("Location: ../../pages/customer/login.php");
}

//--- RECENT ORDERS ---
function getOrdersDashboard() { //select 5 recent orders
	include '../../config/dbconn.php';
  
	$sql = "SELECT *
	FROM orders
	JOIN order_details ON order_details.Order_ID = orders.Order_ID
	JOIN size on size.Size_ID = order_details.Size_ID
	JOIN users on users.User_Id = orders.User_ID
	JOIN product ON product.Product_ID = order_details.Product_ID
	JOIN status ON status.Status_ID = orders.Status_ID
	WHERE orders.Payment_Receipt <> ''
	ORDER BY orders.Order_Date DESC
	LIMIT 5";

	$result = mysqli_query($dbconn, $sql);
	return $result;
  }

  function dispOrdersDashboard($ordersId, $productName, $size, $quantity, $usersName, $status) {
    $color = '';
    if ($status == 'Pending') {
        $color = '#ffbb33';
    } else if ($status == 'Preparing') {
        $color = '#51BBE3';
    } else if ($status == 'Delivered') {
        $color = '#47A3C6';
    } else if ($status == 'Completed') {
        $color = '#41BB12';
    }

    $element = '
    <tbody>
      <tr>
        <td style="padding-right:20px; padding: 15px; border-width:2px;">'.$ordersId.'</td>
        <td style="padding-right:20px; padding: 15px; border-width:2px;">'.$productName.'</td>
        <td style="padding-right:20px; padding: 15px; border-width:2px;">'.$size.'</td>
        <td style="padding-right:20px; padding: 15px; border-width:2px;">'.$quantity.'</td>
        <td style="padding-right:20px; padding: 15px; border-width:2px;">'.$usersName.'</td>
        <td style="padding-right:20px; padding: 15px; border-width:2px;">
            <span style="display: inline-block; padding: 3px 8px; background-color: '.$color.'; color: white; border-radius: 10px;">'.$status.'</span>
        </td>
      </tr>
    </tbody>
    ';
    echo $element;
}
  //--- USERS --- 

  function getUsersDetailsDashboard() { //select 7 customer with recent order
	require '../../config/dbconn.php';
  
	$sql = "SELECT u.*
	FROM users u
	JOIN (
		SELECT DISTINCT orders.User_ID
		FROM orders
		ORDER BY orders.Order_Date DESC
		LIMIT 7
		) recent_orders ON recent_orders.User_ID = u.User_ID";
	$result = mysqli_query($dbconn, $sql);
	return $result;


}

  function users($name, $profilePic, $email) {
	$gmailLink = "https://mail.google.com/mail/?view=cm&fs=1&to=" . urlencode($email);
	$users = '
	<tr style="padding:15px;">
		<td rowspan=2><img src="'.$profilePic.'" alt="" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; overflow: hidden;"/></td>
		<td>username</td>
		<td>'.$name.'</td>
	</tr>
	<tr>
		<td>Email</td>
		<td><a href="' . $gmailLink . '" target="_blank">' . $email . '</a></td>
	</tr>
	';
	echo $users;
  }
?>

