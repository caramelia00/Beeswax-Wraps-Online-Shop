<?php
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['User_ID'])) {
    header("Location: login.php");
    exit();
}

// Include database connection file if needed (uncomment the line below if you need database access)
include "../../config/dbconn.php";

$user_id = $_SESSION['User_ID'];

$sql = "SELECT u.User_Email, u.User_Name, u.User_Full_Name, u.User_Password, u.Profile_Pic,
               ud.Address1, ud.Address2, ud.Postcode, ud.City, ud.State, ud.Phone_No
        FROM users u 
        JOIN user_details ud ON u.User_ID = ud.User_ID
        WHERE u.User_ID = '$user_id'";

$result = mysqli_query($dbconn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $user_email = $row['User_Email'];
    $user_name = $row['User_Name'];
    $user_full_name = $row['User_Full_Name'];
	$Profile_Pic = $row['Profile_Pic'];
	$user_password = $row['User_Password'];
    $address1 = $row['Address1'];
    $address2 = $row['Address2'];
    $postcode = $row['Postcode'];
    $City = $row['City'];
    $State = $row['State'];
    $Phone_No = $row['Phone_No'];
} else {
    // Handle the case where no user is found
    echo "No user found.";
    exit();
}
$password_length = strlen($user_password);
$password_asterisks = str_repeat('*', $password_length);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styleLogin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>User Account Details</title>
    <style>
        body {
            margin: 0;
            background-image: url(loginbg.png);
        }
        #acc {
            margin-left: auto;
            margin-right: auto;
            background-color: #8AB49C;
            border-radius: 40px;
            padding: 20px;
            font-size: 20px;
            color: #9D5A4D;
        }
        table {
            font-family: calibri, sans-serif;
            color: #E6DAD1;
        }
        #header {
            width: 100%;
            background-image: url('header bg pattern.png');
            background-repeat: repeat;
            background-size: contain;
            background-color: #846228;
            padding-left: 10px;
            font-size: 30px;
            color: #E6DAD1;
        }
        a {
            text-align: center;
            color: #E6DAD1;
            text-decoration: none;
        }
        a:hover {
            color: #DE8E04;
        }
        .container {
            width: 400px;
            margin: 0 auto;
            border-radius: 20px;
            background-color: #8AB49C;
            color: #9D5A4D;
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
				<a href="view account details.php">
					<img src="user.png" style="width:71px; height:40px;" class="user">
				</a>
			</td>
		</tr>
	</table>
    <br><br>
	<table id=acc border="0" style="width: 80%;">
		<tr>
			<th colspan=3 style="font-size:40px">ACCOUNT DETAILS</th>
		</tr>
		<tr>
			<td rowspan=6 style="text-align:center">
				<img src="$Profile_Pic" style="width:150px;height:150px;">
			<td style="padding:20px;">Full Name</td>
			<td><?php echo htmlspecialchars($user_full_name); ?></td>
		</tr>
		<tr>
			<td style="padding:20px;">Email</td>
			<td><?php echo htmlspecialchars($user_email); ?></td>
		</tr>
		<tr>
			<td style="padding:20px;">Password</td>
			<td><?php echo htmlspecialchars($password_asterisks); ?></td>
		</tr>
		<tr>
			<td style="padding:20px;">Address 1</td>
			<td><?php echo htmlspecialchars($address1); ?></td>
		</tr>
		<tr>
			<td style="padding:20px;">Address 2</td>
			<td><?php echo htmlspecialchars($address2); ?></td>
		</tr>
		<tr>
			<td style="padding:20px;">Postcode</td>
			<td><?php echo htmlspecialchars($postcode); ?></td>
		</tr>
		<tr>
			<td style="text-align:center; padding-top:10px;">
				<a href="Edit Account Details.php">
					<img src="edit details.png">
				</a>
			</td>
			<td style="padding:20px;">City</td>
			<td><?php echo htmlspecialchars($City); ?></td>
		</tr>
		<tr>
			<td style="text-align:center">
                
			</td>
			<td style="padding:20px;">State</td>
			<td><?php echo htmlspecialchars($State); ?></td>
		</tr>
		<tr>
			<td style="text-align:center">
				<a href="../login.php">
					<img src="log out.png">
				</a>
			</td>
			<td style="padding:20px;">Phone<br>Number</td>
			<td><?php echo htmlspecialchars($Phone_No); ?></td>
		</tr>
	</table>
</body>
</html>
