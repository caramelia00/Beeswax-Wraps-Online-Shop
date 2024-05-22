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
			}
            table{
                font-family:calibri, sans-serif;
                color: #E6DAD1;
            }
			#acc{
                width: 792px;
				margin-left: auto;
				margin-right: auto;
				background-color:#8AB49C;
				border-radius:10px;	
				padding:20px;
				font-size:24px;
                border-spacing: 5px;
			}
            input[type="text"] {
                width: 100%;
                height: 40px;
                padding: 5px;
                border: 1px solid #C7D8CF;
                background-color: #C7D8CF;
                border-radius: 50px;
                box-sizing: border-box;
                margin-bottom: 5px;
                padding-left: 10px;
            }
            #button{
                margin-left: auto;
                margin-right: auto;
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
	<br><br>
    <form action="add new product process.php" method="post">
        <table id=acc border="0">
            <tr>
                <th colspan=3 style="font-size:40px">ADD NEW PRODUCT</th>
            </tr>
            <tr>
                <td>Product Name</td>
                <td colspan=2>
                    <input type="text" name="pName" placeholder="Insert Product Name">
                </td>
            </tr>
            <tr><td>Pricing</td></tr>
            <tr>
                <td>Small</td>
                <td>RM</td>
                <td>
                    <input type="text" name="pSmall" placeholder="Insert Price">
                </td>
            </tr>
            <tr>
                <td>Medium</td>
                <td>RM</td>
                <td>
                    <input type="text" name="pSmall" placeholder="Insert Price">
                </td>
            </tr>
            <tr>
                <td>Large</td>
                <td>RM</td>
                <td>
                    <input type="text" name="pSmall" placeholder="Insert Price">
                </td>
            </tr>
            <tr>
                <td>Image</td>
                <td colspan="2">
                    <form action="/upload" method="post" enctype="multipart/form-data">
                        <input type="file" name="image" accept="image/*">
                        <input type="submit" value="Upload">
                    </form>
                </td>
            </tr>
            <tr>
                <td colspan=3 style="padding-top:10px; text-align: center;">
                    <a href="admin product list.php">
                        <input type="image" src="publish.png" alt="Submit" >
                    </a>
                </td>
            </tr>
        </table>
</form>
</html>