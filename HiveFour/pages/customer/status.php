<?php
 session_start();

 include("dbconn.php");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_received'])) {
    $orderId = $_POST['Status_ID'];


    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update order status to "received"
    $sql = "UPDATE order SET status = 'received' WHERE Status_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $statusID);

    if ($stmt->execute()) {
        echo "<p>Order status updated successfully!</p>";
    } else {
        echo "<p>Error updating order status: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
	<title>Hive4 Status Order</title>
	<head>
		<style>
            body{
                margin:0;
            }
            #one{
                width: 80%;
                background-color: #E6DAD1;
                border-radius: 40px;
                border-spacing: 5px;
                padding: 5px;
                color: #8AB49C;
                margin-left: auto;
                margin-right: auto;
            }
            #status{
                width: 100%;
                border: 1px solid #8AB49C;
                border-radius: 30px;
                padding: 10px;
                padding-left: 40px;
            }
            #summary, #delivery{
                width: 100%;
                height: 310px;
                border: 1px solid #8AB49C;
                border-radius: 30px;
                padding: 10px;
                padding-left: 40px;
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
                background-color: #8AB49C;   
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
                background-color: white;
                border: 1px solid #E6DAD1;
				color: #8AB49C;
                font-size: 12px;
                font-weight: bold;
				text-decoration: none;
                border-radius: 40px;
                padding: 10px;
			}
			button:hover{
				background-color: #E6DAD1;
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
                    <a href="HOME.html">
                        HOME
                    </a>
                </th>
                <th>
                    <a href="search product.php">
                        PRODUCTS
                    </a>
                </th>
                <th>
                    <a href="About Us.html">
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
                    <a href="VIEW ACCOUNT DETAILS.php">
                        <img src="user.png" style="width:71px; height:40px;" class="user">
                    </a>
                </td>
			</tr>
		</table>
		<br><br>
        <table id="one">
            <tr>
                <td colspan="2">
                    <table id="status" border="0">
                        <tr>
                            <td colspan="4" style="font-size: 30px; text-align: left;">STATUS</td>
                        </tr>
                        <tr>
                            <td><b>Order placed</b></td>
                            <td><b>Preparing to ship</b></td>
                            <td><b>Out for delivery</b></td>
                            <td><b>Completed</b></td>
                        </tr>
                        <tr>
                            <td><img src="done.png" width="40px" height="40px"></td>
                            <td><img src="done.png" width="40px" height="40px"></td>
                            <td><img src="done.png" width="40px" height="40px"></td>
                            <td><img src="default.png" width="40px" height="40px"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table id="summary" border="0">
                        <tr>
                            <td colspan="3" style="font-size: 30px;">
                                ORDER SUMMARY
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                ITEMS ORDERED
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="3">
                                <img src="earth.png" style="width: 90px; height: 90px;">
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
                            <td colspan="2" style="font-size: 30px;">
                                DELIVERY DETAILS
                            </td>
                        </tr>
                        <tr>
                            <td colspan="Name">
                                NAME
                                <br>
                                Daniel Choi <br>
                        </tr>
                        <tr>
                            <td colspan="2">
                                ADDRESS
                                <br>
                                Menara TM,<br>
                                Jalan Pantai Baharu, <br>
                                50672 Kuala Lumpur <br>
                                Malaysia
                            </td>
                    </table>
                </td>
            </tr>
            <tr>
            <div class="container">
                <h1>Order Details</h1>
                <p>Order ID: 12345</p>
                <form method="post" action="">
                <input type="hidden" name="Status_ID" value="12345">
                <button type="submit" name="order_received">Order Received</button>
            </form>
            </div>
            </tr>
        </table>
        <script>
            const selectElements = document.querySelectorAll('.mySelect');
            const imageElements = document.querySelectorAll('.myImage');

            selectElements.forEach((selectElement, index) => {
                const imageElement = imageElements[index];

                selectElement.addEventListener('change', function() {
                    const selectedValue = this.value;

                    if (selectedValue === 'default') {
                        // Hide the image when the default option is selected
                        imageElement.style.display = 'none';
                    } else {
                        // Show the image when an option other than the default is selected
                        imageElement.style.display = 'block';

                        const imageSrc = selectedValue === 'true' ? 'done.png' : 'default.png';
                        imageElement.src = imageSrc;

                        if (selectedValue === 'true') {
                            imageElement.style.width = '40px';
                            imageElement.style.height = '40px';
                        } else {
                            imageElement.style.width = '40px';
                            imageElement.style.height = '40px';
                        }
                    }
                });
            });
        </script>
	</body>
</html>
	
