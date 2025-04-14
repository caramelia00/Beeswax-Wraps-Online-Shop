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
	<title>Profile</title>
	<head>
		<style>
			body{
				background-color:#E6DAD1;
				margin: 0;
				padding: 0;
			}
			#acc{
				margin-left: auto;
				margin-right: auto;
				background-color:#8AB49C;
				border-radius:10px;	
				padding:20px;
				font-size:20px;
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
	<br><br>
	<table id=acc border="0">
		<tr>
			<th colspan=3 style="font-size:40px">ACCOUNT DETAILS</th>
			<?php
			dispUserAccDetails();
			?>
		</tr>
		<tr>
			<td style="text-align:center; padding-top:10px;">
				<a href="admin edit details.php">
					<img src="edit details.png">
				</a>
			</td>
		</tr>
		<tr>
			<td style="text-align:center">
				<a href="../../pages/customer/Logout.php">
					<img src="log out.png">
				</a>
			</td>
		</tr>
	</table>
</html>

<?php
} 
Else
{	## if the session username is no admin, redirect the page to the login page 
header("Location: ../../pages/customer/login.php");
}

//display the user info
function dispUserAccDetails(){
	require '../../config/dbconn.php';

	$accId = $_SESSION['User_ID'];

	$sql = "SELECT *
	FROM users WHERE User_ID = '$accId'";
	$result = mysqli_query($dbconn, $sql);
	$row = mysqli_fetch_assoc($result);

	$users = '

	<tr>
		<td rowspan=3 style="text-align:center"><img src="'.$row['Profile_Pic'].'" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; overflow: hidden;"></td>
		<td style="padding:20px;">Full Name</td>
		<td>'.$row['User_Full_Name'].'</td>
	</tr>
	<tr>
		<td style="padding:20px;">Email</td>
		<td>'.$row['User_Email'].'</td>
	</tr>
	<tr>
		<td style="padding:20px;">Password</td>
		<td>********</td>
	</tr>
	<tr>
		<td style="text-align:center; font-size:30px">'.$row['User_Name'].'</td>
	</tr>
	<tr>
		<td style="text-align:center">'.$row['User_ID'].'</td>
	</tr>
	
	';
	echo $users;
}
?>