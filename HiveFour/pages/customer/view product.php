<!DOCTYPE html>
<html>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">
	<title>Hive4 View Product</title>
	<head>
		<style>
			body{
        		margin:0;
      		}
			body{
				background-color:#E6DAD1;
				font-size:24px;
			}
			#top{
				margin-left:auto;
				margin-right:auto;
				padding-top:20px;
				border-spacing:25px;
			}
			#two{
				margin-left:auto;
				margin-right:auto;
				background-color:#E6DAD1;
				border-radius:25px;
				border-right:4px;
				padding:42px;
			}
			#low{
				margin-left:auto;
				margin-right:auto;
				border-spacing:25px;
			}
			#b{
				margin-left:auto;
				margin-right:auto;
				background-color:#8AB49C;
				border-radius:25px;
				padding:15px;
				padding-right:20px;
				height:500px;
				color: #E6DAD1;
			}
			#c{
				margin-left:auto;
				margin-right:auto;
				background-color:#E6DAD1;
				border-radius:25px;
				padding:15px;
				padding-right:20px;
				height:500px;
				color: #8AB49C;
				width: 80%;
			}
			#four{
				margin-left:auto;
				margin-right:auto;			
				background-color:#E6DAD1;
				border-radius:25px;
				padding:15px;
				padding-right:20px;
			}
			#ord{
				border-collapse:collapse;
				border-style:solid;
				border:3px;
				border-color:#8AB49C;
				border: 1px solid #8AB49C;
				padding:20px;
				text-align: left;
				max-width:720px;
				white-space: normal;
				/* Allow text wrapping */
				overflow: hidden;
				/* Hides overflow */
				text-overflow: ellipsis;
				/* Adds ellipsis for overflow */
			}
			#headuser{
				margin-left:auto;
				margin-right:auto;
				background-color:#E6DAD1;
				border-radius:25px;
				padding:15px;
				
			}
			th, td {
				padding: 5px;
				text-align: left;
			}	
			table{
				font-family:calibri, sans-serif;
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
			input{
				padding: 5px;
                border: 1px solid #8AB49C;
                background-color: #8AB49C;
                border-radius: 10px;
                box-sizing: border-box;
                margin-bottom: 10px;
			}
			input[type="submit"] {
                padding: 15px;
                background-color: #8AB49C;
                color: #E6DAD1;
                border: none;
                border-radius: 30px;
                cursor: pointer;
                font-weight: bold;
            }

            input[type="submit"]:hover {
                background-color: #9D5A4D;
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

	<table id=low border="0">
		<tr>
			<td colspan=3>
				<table id=b border="0">
					<tr>
						<td colspan=2>
							<table id=ord border="1">
								<tr>
									<td>
										<img src="view.png">
									</td>
								</tr>
							</table>
						</td>
					</tr>

				</table>
			</td>
			<td colspan=3>
				<table id=c border="0">
					<tr>
						<td style="text-align:left; font-size:50px;">Dried Caesalpinia Flower Beeswax Wraps<br>RM 15.00 - RM 30.00</td>
					</tr>
					<tr>
						<td>
							<b>SIZE</b>
							<br><input type="checkbox" id="myCheckbox" name="myCheckbox">
								<label for="myCheckbox">SMALL (7"X6")</label>
							<br><input type="checkbox" id="myCheckbox" name="myCheckbox">
								<label for="myCheckbox">MEDIUM (10"X11")</label>
							<br><input type="checkbox" id="myCheckbox" name="myCheckbox">
								<label for="myCheckbox">LARGE (13"X14")</label>
						</td>
					</tr>
					<tr>
						<td><b>QUANTITY</b>
							<br><input type="number" name="quantity" min="1" max="1000" value="1">
						</td>
					</tr>
					<tr>
						<td style="font-size: 15px;">
							Stock Available: 123
						</td>
					</tr>
					<tr>
						<td>
							<a href="cart.php">
							<input type="submit" value="ADD TO CART"></a> <a href="checkout.php"><input type="submit" value="BUY NOW"></a>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</html>
