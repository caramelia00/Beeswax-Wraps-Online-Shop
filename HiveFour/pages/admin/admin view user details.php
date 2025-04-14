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
	<title>User Details</title>
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
                padding-top: 20px;
                padding-bottom: 20px;
                padding-left: 50px;
                padding-right: 50px;
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
			<th style="text-align: center; font-size:40px; padding-left: 20px; padding-right: 20px">ACCOUNT DETAILS</th>
		</tr>
        <tr>
            <td>
                <table style border="0">
					<?php
					include '../../config/dbconn.php';
					
					if(isset($_GET['userId'])) {
						$viewUserId= $_GET['userId'];

						$sql = "SELECT *
						FROM users
						JOIN user_details on user_details.User_ID = users.User_ID
						WHERE users.User_ID = '$viewUserId'";
						$result = mysqli_query($dbconn, $sql);

						if ($result && mysqli_num_rows($result) > 0) {
							$row = mysqli_fetch_assoc($result);

							$elements = '
							<tr>
								<td rowspan=3 style="text-align:center"><img src="'.$row['Profile_Pic'].'" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; overflow: hidden;""></td>
								<td style="padding:20px;">Full Name</td>
								<td>'.$row['User_Full_Name'].'</td>
							</tr>
							<tr>
								<td style="padding:20px;">Email</td>
								<td>'.$row['User_Email'].'</td>
							</tr>
							<tr>
								<td style="padding:20px;">Address 1</td>
								<td>'.$row['Address1'].'</td>
							</tr>
							<tr>
								<td style="text-align:center; font-size:30px">'.$row['User_Name'].'</td>
								<td style="padding:20px;">Address 2</td>
								<td>'.$row['Address2'].'</td>
							</tr>
							<tr>
								<td rowspan="5" style="text-align:center; vertical-align: top;">'.$row['User_ID'].'</td>
								<td style="padding:20px;">Postcode</td>
								<td>'.$row['Postcode'].'</td>
							</tr>
							<tr>
								<td style="padding:20px;">City</td>
								<td>'.$row['City'].'</td>
							</tr>
							<tr>
								<td style="padding:20px;">State</td>
								<td>'.$row['State'].'</td>
							</tr>
							<tr>
								<td style="padding:20px;">Phone Number</td>
								<td>'.$row['Phone_No'].'</td>
							</tr>
							';
							echo $elements;
						} else {
							echo "No user found.";
						}
					} else {
						echo "User ID parameter is missing.";
					}
					?>

                </table>        
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
?>