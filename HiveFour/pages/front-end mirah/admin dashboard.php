<?php 
	include '../../config/dbconn.php';
	session_start();
	## veryify if the session user is admin
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
				background-color:#E6DAD1;
				margin: 0;
				padding: 0;
				/* font-size: 20px; */
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
						$sql = "SELECT COUNT(Order_ID) FROM orders";
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
						$sql = "SELECT SUM(Order_Price) FROM orders";
						$result = mysqli_query($dbconn,$sql);
						$row = mysqli_fetch_array($result);
						echo 'RM '.$row[0];
		
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
							<table id=ord border="0">
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
											<tr style="padding:15px;">
												<td rowspan=2><img src="yawnzzn.png"></td>
												<td>username</td>
												<td>yawnzzn</td>
											</tr>
											<tr>
												<td>user ID</td>
												<td>123456</td>
											</tr>
											<tr style="padding:15px;">
												<td rowspan=2><img src="mineji.png"></td>
												<td>username</td>
												<td>mineji</td>
											</tr>
											<tr>
												<td>user ID</td>
												<td>654321</td>
											</tr>
											<tr >
												<td rowspan=2 ><img src="for_everyoung10.png"></td>
												<td>username</td>
												<td>for_everyoung10</td>
											</tr>
											<tr>
												<td>user ID</td>
												<td>456123</td>
											</tr>
											<tr style="padding:15px;">
												<td rowspan=2><img src="hoonparker.png"></td>
												<td>username</td>
												<td>hoonparker</td>
											</tr>
											<tr>
												<td>user ID</td>
												<td>321654</td>
											</tr>
											<?php

											$result = getUsersDetailsDashboard();
											while ($row = mysqli_fetch_assoc($result)) {
												users($row['User_ID'], $row['Type_Name'], $row['User_Email'], $row['phoneNum']);
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
</html>

<?php
} 
Else
{	## if the session username is no admin, redirect the page to the login page 
header("Location: admin login.php");
}

//--- RECENT ORDERS ---
function getOrdersDashboard() {
	include '../../config/dbconn.php';
  
	$sql = "SELECT orders.Order_ID, order_details.Quantity, order_details.Size_ID, product.Product_Name, users.User_Name, status.Status_Name
	FROM orders
	JOIN order_details ON order_details.Order_ID = orders.Order_ID
	JOIN product ON product.Product_ID = order_details.Product_ID
	JOIN users ON users.User_ID = orders.User_ID
	JOIN status ON status.Status_ID = orders.Status_ID
	ORDER BY orders.Order_Date DESC";
	$result = mysqli_query($dbconn, $sql);
	return $result;
  }

function dispOrdersDashboard($ordersId,$productName,$size,$quantity,$usersName,$status) {
	$color = '';
	if($status == 'Pending') {
	  $color = 'color:#ffbb33';
	  $colors = 'orange';
	}
	else if($status == 'Preparing') {
	  $color = 'color:#51BBE3';
	  $colors = 'light blue';
	}
	else if($status == 'Delivered') {
	  $color = 'color:#47A3C6';
	  $colors = 'dark blue';
	}
	else if($status == 'Completed') {
	  $color = 'color:#41BB12';
	  $colors = 'green';
	}
	
	$element = '
  
	<tbody>
	  <tr>
		<td style="padding-right:20px; padding: 15px; border-width:2px;">'.$ordersId.'</td>
		<td style="padding-right:20px; padding: 15px; border-width:2px;">'.$productName.'</td>
		<td style="padding-right:20px; padding: 15px; border-width:2px;">'.$size.'</td>
		<td style="padding-right:20px; padding: 15px; border-width:2px;">'.$quantity.'</td>
		<td style="padding-right:20px; padding: 15px; border-width:2px;">'.$usersName.'</td>
		<td style="padding-right:20px; padding: 15px; border-width:2px; '.$color.';">
			<span class="status '.$colors.'"></span>'.$status.'
		</td>
	  </tr>
	</tbody>
  
	';
	echo $element;
  }

  //--- USERS ---
  function getUsersDetails() {
	require '../../config/dbconn.php';
  
	$sql = "SELECT users.User_ID, users.User_Name, users.User_Email, users.usersUid,
	user_details.Phone_No, user_details.address, user_details.postcode, user_details.city,
	user_details.State, user_type.Type_Name
	FROM users
	JOIN user_details ON users.User_ID = user_details.User_ID
	JOIN user_type ON users.Type_ID = user_type.Type_ID
	WHERE user_type.Type_Name = 2";
	$result = mysqli_query($dbconn, $sql);
	return $result;
  }

  function users($name, $type, $email, $phone) {
	$users = '
	<div class="card-body">
	  <div class="customer">
		<div class="info">
		  <img src="../assets/img/default-profile.jpg" width="40px" height="40px" alt="" />
		  <div>
			<h4>'.$name.'</h4>
			<small>'.$type.'</small>
		  </div>
		</div>
		<div class="contact">
		  <a href="mailto:'.$email.'"><span class="bx bx-envelope"></span></a>
		  <a href="http:///wa.me/'.$phone.'" target="_blank"><span class="bx bxl-whatsapp"></span></a>
		</div>
	  </div>
	</div>
	';
	echo $users;
  }
?>