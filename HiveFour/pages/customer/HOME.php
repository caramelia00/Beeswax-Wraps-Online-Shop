<?php
	session_start();
	
    // Hide error reporting
    error_reporting(0);
    ini_set('display_errors', 0);

    $session = isset($_SESSION['User_ID']) ? $_SESSION['User_ID'] : null;
?>
<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
	<title>Home</title>
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

			@keyframes moveUp {
            from { transform: translateY(100px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
			}

			.move-up {
				animation: moveUp 1s forwards;
			}

			body{
        		margin:0;
      		}
			body{
				background-image: url(Untitled\ design\ \(1\).png);
            	background-repeat: no-repeat;
				background-size: cover;
				background-attachment: fixed;
				background-position: bottom;
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
		<?php
			if (empty($session)) {
		?>
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
		<?php }else{?>
			<?php include 'customer header.php'; ?>
		<?php }?>
	</table>
	<br>
	<table style="color: black; width: 100%; margin: 0 auto; text-align: center;">
		<tr>
			<td style="font-size: 100px; font-family: 'Times New Roman'; line-height: 1.9;" class="pop-up">
				BEESWAX WRAPS<br>
			</td>
		</tr>
		<tr>
			<td style="font-size: 35px; font-family:Verdana;" class="move-up">
				Say goodbye to plastic and hello to
				<br>sustainable freshness of our beeswax
				<br>wrap, one wrap at a time. <br>
				<img src="wraps demo.png"  style="width: 30%; text-align: center;"> 
			</td>
		</tr>
	</table>
</html>
