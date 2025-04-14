<?php
session_start();

include '../../config/dbconn.php';

if(isset($_POST['submit'])){
   // Retrieve and sanitize user inputs
	$email = mysqli_real_escape_string($dbconn, $_POST['email']);
	$password = mysqli_real_escape_string($dbconn, $_POST['pass']);

	$sql= "SELECT * FROM users WHERE User_Email = '$email'";
	$query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
	$row = mysqli_num_rows($query);

	if ($row > 0) {
        $r = mysqli_fetch_assoc($query);

		$hashes_password = $r['User_Password'];

        // Verify the password
		//if ($password == $r['User_Password']) {
        if (password_verify($password, $hashes_password)) {
			if($r['Type_ID']=='UT02'){
				$_SESSION['username'] = "Administrator";
				$_SESSION['User_ID'] = $r['User_ID'];
			
				header("Location: ../../pages/admin/admin dashboard.php");
				exit();
			}
			else{       
				$_SESSION['username'] = "Customer";
				$_SESSION['User_ID'] = $r['User_ID'];
	
				header("Location: search product.php");
			exit();
			}
        } else {
            echo "<script>
			alert('Incorrect email or password.');
			</script>";
        }
    } else {
        echo "<script>
			alert('Incorrect email or password.');
			</script>";
    }

	// if($row == 0){  
	// 	echo "<script>
	// 		alert('Incorrect email or password.');
	// 		window.location.href = 'login.php';
	// 		</script>";
	// }
	// else{
	// 	$r = mysqli_fetch_assoc($query);
	// 	if($r['Type_ID']=='UT02'){
	// 		$_SESSION['username'] = "Administrator";
	// 		$_SESSION['User_ID'] = $r['User_ID'];
		
	// 		// echo "<pre>";
	// 		// var_dump($_SESSION);
	// 		// echo "</pre>";

	// 		header("Location: ../../pages/admin/admin dashboard.php");
	// 		exit();
	// 	}
	// 	else{       
	// 		$_SESSION['username'] = "Customer";
	// 		$_SESSION['User_ID'] = $r['User_ID'];
		
	// 		// echo "<pre>";
	// 		// var_dump($_SESSION);
	// 		// echo "</pre>";

	// 		header("Location: search product.php");
	// 	exit();
	// 	}
	// }
}
mysqli_close($dbconn);
?> 
<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
	<title>Login</title>
	<head>
		<style>
			@keyframes pop {
            0% { transform: scale(0.5); opacity: 0; }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); opacity: 1; }
			}

			.pop-up {
				animation: pop 1s;
			}

			body{
        		margin:0;
      		}
			body{
				background-image: url(loginbg.png);
				background-size: cover;
				background-repeat: no-repeat;
				background-position: center;
			}
			#acc{
				margin-left: auto;
				margin-right: auto;
				background-color:#8AB49C;
				border-radius:40px;	
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
            .container {
            width: 400px;
            margin: 0 auto;
            border-radius: 20px;
            background-color:#8AB49C;
            color: #9D5A4D;
            }
            label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
                border-radius: 30px;
                padding-left: 20px;
                text-align:left;
            }

            input[type="text"],
            input[type="email"],
            input[type="password"],
            input[type="tel"] {
                width: 100%;
                padding: 5px;
                border: 1px solid #C7D8CF;
                background-color: #C7D8CF;
                border-radius: 10px;
                box-sizing: border-box;
                margin-bottom: 10px;
            }

            input[type="submit"] {
                width: 100%;
                padding: 15px;
                background-color: #C7D8CF;
                color: #9D5A4D;
                border: none;
                border-radius: 30px;
                cursor: pointer;
                font-weight: bold;
            }

            input[type="submit"]:hover {
                background-color: white;
            }
		</style>
	</head>
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
			<td colspan=2><img src="design 1.png"  style="width:80px; height:80px; padding-right: 100px;">
			<th style="padding-left:60px;">
				<a href="login.php">
					LOGIN
				</a>
			</th>
			<th>
				<a href="register1.php">
					REGISTER
				</a>
			</th>
		</tr>
	</table>
	<div class="pop-up">
		<br><br>
		<table id=acc border="0">
				<tr>
				<td style="text-align: center; color: #E6DAD1; padding: 20px;">
					<b style=" font-family: 'Times New Roman'; font-size: 30px;">LOGIN</b>
					<table id="acc" border="0">
					<form action="" method="POST" style="width: 300px; margin: 0 auto;">
						<div class="container">
							<label for="email">Email:</label>
							<input type="email" id="email" name="email">
						</div>
						<div class="container">
							<label for="password">Password:</label>
							<input type="password" id="password" name="pass">
						</div>
						<div style="width: 300px; margin: 0 auto;">
							<input type="submit" name="submit" value="LOGIN">
						</div>
					</form>
				</td>
			</tr>
    	</table>
		  Don't have an account yet? <a href ="register1.php">REGISTER</a>
		  </td>
		  </tr>
	</div>
	</table>
</html>