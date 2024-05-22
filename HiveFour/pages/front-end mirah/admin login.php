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
				background-image: url('loginbg.png');
				background-repeat: no-repeat;
				background-size: cover;
				background-attachment: fixed;
				background-position: bottom;
			}
			
			#login{
                margin-left: auto;
				margin-right: auto;
				background-color:#8AB49C;
				border-radius:30px;	
				padding-left:50px;
                padding-right:50px;
                padding-top:20px;
                padding-bottom:20px;
				font-size:20px;
                
			}
			#details{
                width: 400px;
                background-color:#C7D8CF; 
				border-radius:15px;	
			}	
			#em {
				background-color:#C7D8CF;
				color:#9D5A4D;
				padding:10px;
			}
			table{
				font-family:calibri, sans-serif;
				color: #E6DAD1;
			}
			a{
                color: #E6DAD1;
				text-decoration: none;
			}
            input[type="text"] {
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
                text-align: center;
                background-image: url('header bg pattern.png');
                background-repeat: repeat;
                background-size: contain;
                background-color: #846228;
                font-size:22px;			
            }
		</style>
	</head>
	<table id=header  border="0">
		<tr>
			<th><img src="design 1.png"  style="width:80px; height:80px;"></td>
		</tr>
	</table>
	<br><br><br><br>
	<form action="admin login process.php" method="post">
		<table id=login border="0">
			<tr>
				<th colspan=2 style="padding:10px; font-size: 40px; font-family: 'Times New Roman', serif;"">LOGIN</th>
			</tr>
			<tr>
				<td>
					<table id=details border="0">
						<tr>
							<td style=" color:#9D5A4D;">Email</td>
						</tr>
						<tr>
							<td ><input type="text" name="adEmail"></td>
						</tr>
                    </table>
                    <br>
                    <table id=details border="0">
						<tr >
							<td style=" color:#9D5A4D;">Password</td>
						</tr>
						<tr>
							<td ><input type="text" name="adPass"></td>
						</tr>
                    </table>
				</td>
			</tr>
            <tr>
                <td style=" padding-top: 10px; text-align: center;">
                    <input type="image" src="login.png" alt="Submit" >
                </td>
            </tr>
		</table>
	</form>
</html>