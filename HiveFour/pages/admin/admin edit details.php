<?php
	session_start();

	include '../../config/dbconn.php';
	
	$userId = $_SESSION['User_ID']; 

	$sql= "SELECT * FROM users WHERE users.User_ID= '$userId'";

	$query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error());
	$row = mysqli_num_rows($query);
	
	if($row == 0){
		echo "No record found";
	}
	else{
		$r = mysqli_fetch_assoc($query);
		$uId= $r['User_ID']; 
		$uName= $r['User_Name']; 
		$uFullName= $r['User_Full_Name']; 
		$uEmail= $r['User_Email']; 
		$profPic= $r['Profile_Pic'];
		$pw = $r['User_Password'];
	}

	##If the update button is clicked 
	if(isset($_POST['update'])){

		##	capture values from HTML form 
		if($_POST['pw'] != $_POST['confirmPw'] ){
			echo "<script>
				alert('Password is not matching');
				window.location.href = 'admin edit details.php';
			</script>";
		}else{
			$uId= $_SESSION['User_ID']; 
			$uName= $_POST['username']; 
			$uFullName= $_POST['fullname']; 
			$uEmail= $_POST['email']; 
			$pw= $_POST['pw'];
			$confirmPw = $_POST['confirmPw'];
			$hashed_password = password_hash($pw, PASSWORD_BCRYPT); // Hash the password

			/* execute SQL SELECT command */
			$sqlUName = "SELECT User_Name FROM users WHERE User_Name = '$uName' AND User_ID !='$uId' ";
			$qUName = mysqli_query($dbconn, $sqlUName);
		
			if (!$query) {
				die("Error: " . mysqli_error($dbconn));
			}
		
			$rUName = mysqli_num_rows($qUName);

			if (empty($_POST['fullname']) || empty($_POST['username']) || empty($_POST['email']) || empty($_POST['pw']) || empty($_POST['confirmPw'])) {
				echo "<script>
					alert('One or more fields are empty!');
				</script>";
			}else if($rUName != 0){
				echo "<script>alert('The username is already existed'); 
						</script>";
			}else{
				// Image upload handling
				if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
					$file = $_FILES['image'];

					$fileName = $_FILES['image']['name'];
					$fileTmpName = $_FILES['image']['tmp_name'];
					$fileSize = $_FILES['image']['size'];
					$fileError = $_FILES['image']['error'];
					$fileType = $_FILES['image']['type'];

					$fileExt = explode('.', $fileName);
					$fileActualExt = strtolower(end($fileExt));

					$allowed = array('jpg','jpeg','png');

					if(in_array($fileActualExt, $allowed)) {
						if($fileError === 0) {
							//file size must be < 10MB
							if($fileSize < 10485760) {
								$fileNameNew = $uId.".".$fileActualExt;
								$fileDestination = '../../assets/userPic/'. $fileNameNew;

								move_uploaded_file($fileTmpName, $fileDestination); //to upload file to a specific folder

								## execute SQL UPDATE command 
								$sqlUpdate = "UPDATE users SET User_Full_Name = '" . $uFullName . "', User_Name = '" . $uName . "',
								User_Email= '" . $uEmail . "', User_Password = '" . $hashed_password . "', Profile_Pic = '$fileDestination'
								WHERE User_ID = '" . $uId . "'";
								
								mysqli_query($dbconn, $sqlUpdate) or die ("Error: " . mysqli_error($dbconn));
								/* display a message */
								echo "<script>
										alert('Data has been updated');
										window.location.href = 'admin view account.php';
									</script>";
							} else {
								echo "<script>
									alert('File is too big!');
								</script>";   
							}
						} else {
							echo "<script>
								alert('There is an error in this file!');
							</script>";  
						}
					} else {
						echo "<script>
							alert('PNG, JPG, JPEG only!');
						</script>";  
					} 
				}else {
						// Execute SQL UPDATE command without image upload
						$sqlUpdate = "UPDATE users SET 
							User_Full_Name = '$uFullName', 
							User_Name = '$uName',
							User_Email = '$uEmail', 
							User_Password = '$hashed_password'
							WHERE User_ID = '$uId'";
	
						if (mysqli_query($dbconn, $sqlUpdate)) {
							echo "<script>
								alert('Data has been updated');
								window.location.href = 'admin view account.php';
							</script>";
						} else {
							die("Error updating record: " . mysqli_error($dbconn));
						}
					}
				}
			}
		}
?>

<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
	<title>Edit Account Details</title>
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
				padding-top:40px;
                padding-bottom:40px;
                padding-left: 20px;
                padding-right: 20px;
				font-size:20px;
			}
			table{
				font-family:calibri, sans-serif;
				color: #E6DAD1;
			}
            input[type="text"],
			input[type="password"] {
                width: 100%;
                padding: 5px;
                border: 1px solid #C7D8CF;
                background-color: #C7D8CF;
                border-radius: 5px;
                box-sizing: border-box;
                margin-bottom: 5px;
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
	</table>
	<br><br>
	<form id="editForm" action="" method="POST" enctype="multipart/form-data">
		<table id=acc border="0">
			<tr>
				<th colspan=3 style="font-size:40px">ACCOUNT DETAILS</th>
			</tr>
			<tr>
				<td rowspan=4 style="text-align:center"><img src="<?php echo $profPic; ?>" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; overflow: hidden;"></td>
				<td style="padding:10px;">Full Name</td>
				<td><input type="text" id="fullname" name="fullname" value="<?php echo $uFullName; ?>"></td>
			</tr>
			<tr>
				<td style="padding:10px;">Username</td>
				<td><input type="text" id="username" name="username" value="<?php echo $uName; ?>"></td>
			</tr>
			<tr>
				<td style="padding:10px;">Email</td>
				<td><input type="text" id="email" name="email" value="<?php echo $uEmail; ?>"></td>
			</tr>
			<tr>
                <td style="padding:10px;">Password</td>
				<td><input type="password" id="pw" name="pw" value="<?php echo $pw ?>"></td>
			</tr>
			<tr>
				<td><input type="file" name="image" accept="image/*"></td>
				<td style="padding:10px;">Confirm Password</td>
				<td><input type="password" id="pw" name="confirmPw" value="<?php echo $pw ?>"></td>
			</tr>
			<tr>
				<td><span style="color: white; font-size: 13px; font-style: italic;"> File type: .jpg, .jpeg, & .png only & max 10MB </span></td>
			</tr>
			<tr>
                <td style="text-align:center"><?php echo $uId; ?></td>
			</tr>
			<tr>
				<td colspan="3" style="padding-top:10px; text-align:center;">
					<button type="submit" name="update" style="background: none; border: none; padding: 0; cursor: pointer;">
						<img src="save details.png" alt="Submit" value="update" style="display: inline-block;">
					</button>	
				</td>
			</tr>
		</table>
	</form>
</html>