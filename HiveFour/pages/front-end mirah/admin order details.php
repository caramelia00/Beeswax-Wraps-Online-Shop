<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
	<title>Hive4</title>
	<head>
		<style>
            #one{
                width: 800px;
                height: 650px;
                background-color: #8AB49C;
                border-radius: 40px;
                border-spacing: 5px;
                padding: 5px;
                color: #E6DAD1;
                margin-left: auto;
                margin-right: auto;
                
            }
            #status{
                width: 790px;
                height: 100px;
                border: 1px solid #E6DAD1;
                border-radius: 30px;
                padding: 10px;
            }
            #summary, #delivery{
                width: 390px;
                height: 445px;
                border: 1px solid #E6DAD1;
                border-radius: 30px;
                padding: 10px;
                font-size:24px;
            }
            .mySelect{
                background-color: #C7D8CF;
                border: 1px solid #C7D8CF;
                color: #846228;
            }
            #startDateButton, #endDateButton{
                height: 40px;  
                width: 40px;
            }
            #save{
                margin-left: auto;
                margin-right: auto;
            }
            .sve{
                border-radius:15px;
                padding:5px;
                background-color: #e6dad1;
                color: #846228;
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
            body{
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                background-color: #E6DAD1;   
                margin: 0;
				padding: 0;
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
            button{
				text-align: center;
                background-color: #8AB49C;
                border: 1px solid #8AB49C;
				color: #E6DAD1;
                font-size: 24px;
				text-decoration: none;
			}
			button:hover{
				color: #5e7b6a;
			}
			.user:hover {
				opacity: 0.8;
			}

			.user:hover + p {
				display: block;
			}
		</style>
	</head>
	<body>
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
        <form action="update order details process.php" method="post">
            <table id="one" border="0">
                <tr>
                    <td colspan="2">
                        <table id="status" border="0">
                            <tr>
                                <th colspan="4" style="font-size: 30px; text-align: left;">STATUS</th>
                            </tr>
                            <tr>
                                <td>Order placed</td>
                                <td>Preparing to ship</td>
                                <td>Out for delivery</td>
                                <td>Completed</td>
                            </tr>
                            <tr>
                                <td>
                                    <select class="mySelect">
                                        <option value="default">Select Status</option>
                                        <option value="true">Yes</option>
                                        <option value="false">No</option>
                                    </select>
                                    <input type="hidden" name="statusImg" class="order-status-input">
                                    <img class="myImage" style="display: none;" alt="Image">
                                </td>
                                <td>
                                    <select class="mySelect">
                                        <option value="default">Select Status</option>
                                        <option value="true">Yes</option>
                                        <option value="false">No</option>
                                    </select>
                                    <input type="hidden" name="statusImg" class="order-status-input">

                                    <img class="myImage" style="display: none;" alt="Image">
                                </td>
                                <td>
                                    <select class="mySelect">
                                        <option value="default">Select Status</option>
                                        <option value="true">Yes</option>
                                        <option value="false">No</option>
                                    </select>
                                    <input type="hidden" name="statusImg" class="order-status-input">
                                    <img class="myImage" style="display: none;" alt="Image">
                                </td>
                                <td>
                                    <select class="mySelect">
                                        <option value="default">Select Status</option>
                                        <option value="true">Yes</option>
                                        <option value="false">No</option>
                                    </select>
                                    <input type="hidden" name="statusImg" class="order-status-input">
                                    <img class="myImage" style="display: none;" alt="Image">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table id="summary" border="0">
                            <tr>
                                <th colspan="3" style="font-size: 30px;">
                                    ORDER SUMMARY
                                </th>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    ITEMS ORDERED
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="3">
                                    <img src="wrap 3.png" style="width: 130px; height: 130px;">
                                </td>
                                <td colspan="2">
                                    Earth & Sun Beeswax Wraps
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    Size: L
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    X2
                                </td>
                                <td style="text-align: right;">
                                    RM30.00
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Items Subtotal
                                </td>
                                <td colspan="2">
                                    RM60.00
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Shipping Fee
                                </td>
                                <td colspan="2">
                                    RM5.00
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Total Payment
                                </td>
                                <td colspan="2" style="font-size: 30px;">
                                    RM65.00
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table id="delivery" border="0">
                            <tr>
                                <th colspan="2" style="font-size: 30px;">
                                    DELIVERY DETAILS
                                </th>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    ADDRESS
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    Menara TM,<br>
                                    Jalan Pantai Baharu, <br>
                                    50672 Kuala Lumpur <br>
                                    Malaysia
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    ESTIMATED DELIVERY DATE
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="start date">Start Date:</label>
                                    <br>
                                    <label for="end date">End Date:</label>
                                </td>
                                </td>
                                <td>
                                    <!-- ni untuk letak estimated delivery date -->
                                    <input type="date" id="start date" name="startDate">
                                    <br>
                                    <input type="date" id="end date" name="endDate">
                                    <input type="submit" value="Change Date">
                                </td>                     
                            </tr>
                            <tr>
                                <td colspan="2">
                                    ORDER ID
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    1024
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table id="save" border="0">
                            <tr>
                                <td>
                                        <button type="submit" class="sve">SAVE CHANGES</button>
                                </td>
                            </tr>
                    </td>
                </tr>
            </table>
        </form>
        <script src="updOrd.js"></script>
	</body>
</html>
