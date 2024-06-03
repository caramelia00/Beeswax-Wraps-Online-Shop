<?php 
session_start();

include '../../config/dbconn.php';

if (isset ($_POST['submit']))
{
    //retrieve for user input (cust)

    $email = mysqli_real_escape_string ($dbconn, $_POST ['email']);
    $password = mysqli_real_escape_string ($dbconn, $_POST ['pass']);

    $sql = "SELECT * FROM user WHERE Type_UT01 AND User_Email ='$email' AND User_Password = '$password'";
    $query = mysqli_query($dbconn, $sql) or die ("Error ".mysqli_error ($dbconn));
    $row = mysqli_num_rows ($query);

    if ($row == 0)
    {
        echo "<script>
            alert ('Incorrect email or password');
            window.location.href = 'login.php' ;
            </script>";
    }
    else 
    {
        //$r = mysqli_fetch_assco($query);

        $_SESSION ['username'] = "Customer";
        $_SESSION ['User_ID'] = $r['User_ID'];

        echo "<pre>";
        var_dump($_SESSION);
        echo "<?pre>";

      //  header ("Location: dashboard.php")
        exit();
    }
}
mysqli_close($dbconn);
?>
<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
	<title>Hive4 LOGIN</title>
	<head>
		<style>
			body{
				background-image: url(loginbg.png);
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
				<a href="HOME.html">
					HOME
				</a>
			</th>
			<th>
				<a href="search product.html">
					PRODUCTS
				</a>
			</th>
			<th>
				<a href=".html">
				ABOUT US
				</a>
			</th>
			<td colspan=2><img src="design 1.png"  style="width:80px; height:80px;"></td>
			<th style="padding-left:60px;">
				<a href="LOGIN.html">
					LOGIN
				</a>
			</th>
			<th>
				<a href="REGISTER.html">
					REGISTER
				</a>
			</th>
		</tr>
	</table>
	<br><br>
	<table id=acc border="0">
			<tr>
			  <td style="text-align: center; color: #E6DAD1; padding: 20px;">
				<b style=" font-family: 'Times New Roman'; font-size: 30px;">LOGIN</b>
		  <table style="width:300px; margin: 0 auto;">
			<tr>
			  <td>
				<div class="container">
				  <form style="background-color: #C7D8CF; border-radius: 20px;">
					<label for="email">Email:</label>
					<input type="email" id="email" name="email">
				  </form>
				</div>
			</td>
		  </tr>
		  <tr>
			  <td>
				  <div class="container">
					<form style="background-color: #C7D8CF; border-radius: 20px;">
					  <label for="password">Password:</label>
					  <input type="password" id="password" name="password">
					</form>
				  </div>
			  </td>
		  </tr>
		  <tr>
			<td colspan="2">
			  <div style="width: 300px; margin:0 auto;">
				<form>
				  <input type="submit" value="LOGIN">
				</form>
			  </div>
			</td>
			<td>
			</td>
		  </tr>
		  </table>
		  Don't have an account yet? REGISTER
		  </td>
		  </tr>
	</table>
</html>
