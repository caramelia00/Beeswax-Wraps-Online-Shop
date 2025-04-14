<?php
		session_start();

		include '../../config/dbconn.php';

		$userId = $_SESSION['User_ID'];
	
		$sql= "SELECT * 
		FROM users 
		JOIN user_details on user_details.User_ID = users.User_ID
		WHERE users.User_ID= '$userId'";
	
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
			$address1 = $r['Address1'];
			$address2 = $r['Address2'];
			$postcode = $r['Postcode'];
			$City = $r['City'];
			$State = $r['State'];
			$Phone_No = $r['Phone_No'];
		} 

		if (isset($_POST['update'])) {
			// Retrieve the form data
			$uName = $_POST['username'];
			$uFullName = $_POST['fullname'];
			$uEmail = $_POST['email'];
			$pw = $_POST['pw'];
			$hashed_password = password_hash($pw, PASSWORD_BCRYPT); // Hash the password
			$address1 = $_POST['address1'];
			$address2 = $_POST['address2'];
			$postcode = $_POST['postcode'];
			$City = $_POST['city'];
			$State = $_POST['state'];
			$Phone_No = $_POST['phone_no'];

			/* execute SQL SELECT command */
			$sqlUName = "SELECT User_Name FROM users WHERE User_Name = '$uName' AND User_ID !='$uId' ";
			$qUName = mysqli_query($dbconn, $sqlUName);
		
			if (!$query) {
				die("Error: " . mysqli_error($dbconn));
			}
		
			$rUName = mysqli_num_rows($qUName);

			if (empty($uName) || empty($uFullName) || empty($uEmail) || empty($pw) || empty($address1) || empty($address2) || empty($postcode) || empty($City) || empty($State) || empty($Phone_No)) {
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

								// Update the database
								$sqlUpdate= "UPDATE users
								JOIN user_details ON user_details.User_ID = users.User_ID
								SET 
									users.User_Name = '$uName',
									users.User_Full_Name = '$uFullName',
									users.User_Email = '$uEmail',
									users.User_Password = '$hashed_password',
									user_details.Address1 = '$address1',
									user_details.Address2 = '$address2',
									user_details.Postcode = '$postcode',
									user_details.City = '$City',
									user_details.State = '$State',
									user_details.Phone_No = '$Phone_No',
									Profile_Pic = '$fileDestination'
								WHERE users.User_ID = '$userId'";
						
								if (mysqli_query($dbconn, $sqlUpdate)) {
									echo "<script>
											alert('Record updated successfully');
											window.location.href = 'view account details.php';
										</script>";
								} else {
									echo "Error updating record: " . mysqli_error($dbconn);
								}
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
				}else{
					// Update the database
					$sqlUpdate= "UPDATE users
					JOIN user_details ON user_details.User_ID = users.User_ID
					SET 
						users.User_Name = '$uName',
						users.User_Full_Name = '$uFullName',
						users.User_Email = '$uEmail',
						users.User_Password = '$hashed_password',
						user_details.Address1 = '$address1',
						user_details.Address2 = '$address2',
						user_details.Postcode = '$postcode',
						user_details.City = '$City',
						user_details.State = '$State',
						user_details.Phone_No = '$Phone_No'
					WHERE users.User_ID = '$userId'";
			
					if (mysqli_query($dbconn, $sqlUpdate)) {
						echo "<script>
								alert('Record updated successfully');
								window.location.href = 'view account details.php';
							</script>";
					} else {
						echo "Error updating record: " . mysqli_error($dbconn);
					}
				}
			}
		}
	?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styleLogin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Edit Account Details</title>
    <style>
        body {
            margin: 0;
            background-image: url(loginbg.png);
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;
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
		input[type="text"],
		input[type="password"] {
			width: 60%;
			padding: 5px;
			border: 1px solid #C7D8CF;
			background-color: #C7D8CF;
			border-radius: 5px;
			box-sizing: border-box;
			margin-bottom: 5px;
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
<?php include 'customer header.php'; ?>
    <br><br>
	<form action="" method="POST" enctype="multipart/form-data">
	<table id=acc border="0" style="width: 80%;">
		<tr>
			<th colspan=3 style="font-size:40px">ACCOUNT DETAILS</th>
		</tr>
		<tr>
			<td rowspan=4 style="text-align:center"><img src="<?php echo $profPic; ?>" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; overflow: hidden;"></td>
			<td style="padding:10px;">Username</td>
			<td><input type="text" id="username" name="username" value="<?php echo $uName; ?>"></td>
		</tr>	
		<tr>
			<td style="padding:10px;">Full Name</td>
			<td><input type="text" id="fullname" name="fullname" value="<?php echo $uFullName; ?>"></td>
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
			<td style="text-align:center">
				<input type="file" name="image" accept="image/*">
			</td>
			<td style="padding:10px;">Address 1</td>
			<td><input type="text" id="address1" name="address1" value="<?php echo $address1; ?>"></td>
		</tr>
		<tr>
			<td style="text-align:center;"><span style="color: white; font-size: 13px; font-style: italic;"> File type: .jpg, .jpeg, & .png only & max 10MB </span></td>
			<td style="padding:10px;">Address 2</td>
			<td><input type="text" id="address2" name="address2" value="<?php echo $address2; ?>"></td>
		</tr>
		<tr>
			<td rowspan =2 style="text-align:center; padding-top:10px;">

			<button type="submit" name="update" style="background: none; border: none; padding: 0; cursor: pointer;">
				<img src="save changes.png" alt="Submit" value="update" style="width: 180px; height: 50px; display: inline-block;">
			</button>	

			</td>
			<td style="padding:10px;">Postcode</td>
			<td><input type="text"  name="postcode" value="<?php echo $postcode ?>"></td>
		</tr>
		<td style="padding:10px;">City</td>
		<td><input type="text" id="city" name="city" value="<?php echo $City ?>"></td>
		<tr>
			<td rowspan =2 style="text-align:center">
				<a href="view account details.php">
					<img src="back.png">
				</a>
			</td>
			<td style="padding:10px;">State</td>
			<td><input type="text" name="state" value="<?php echo $State ?>"></td>
		</tr>
		<tr>
			<td style="padding:10px;">Phone Number</td>
			<td><input type="text" name="phone_no" value="<?php echo $Phone_No ?>"></td>
				</table>
			</td>
		</tr>
	</table>
	</form>
</body>
</html>	
