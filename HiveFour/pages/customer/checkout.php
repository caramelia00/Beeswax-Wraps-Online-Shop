<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
	<title>Hive4 Checkout</title>
	<head>
		<style>
            body{
                margin:0;
            }
            #one{
                width: 70%;
                background-color: #E6DAD1;
                border-radius: 40px;
                padding: 5px;
                color: #8AB49C;
                margin: 0 auto;
            }
            #summary{
                width: 90%;
                height: 310px;
                border: 1px solid #8AB49C;
                border-radius: 30px;
                padding: 10px;
            } 
            #pay{
                width: 90%;
                height: 250px;
                border: 1px solid #8AB49C;
                border-radius: 30px;
                padding: 10px;
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
                width: 100%;
                padding: 10px;
                background-color: white;
                color: #9D5A4D;
                border: none;
                border-radius: 30px;
                cursor: pointer;
                font-weight: bold;
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
            input[type="submit"] {
                width: 100%;
                padding: 10px;
                background-color: white;
                color: #9D5A4D;
                border: none;
                border-radius: 30px;
                cursor: pointer;
                font-weight: bold;
            }

            input[type="submit"]:hover {
                background-color: #E6DAD1;
            }
		</style>
	</head>
	<body>
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
		<br><br>
        <table id="one">
            <tr>
                <td colspan="4" style="width: 100%;">
                    <table border="0" style="width: 100%;">
                        <tr>
                            <td style="text-align: right; margin: 0 auto;">
                                <img src="preparing.png" width="60px" height="60px">
                            </td>
                            <td style="text-align: center; margin: 0 auto;">
                                <img src="shipped.png" width="110px" height="50px">
                            </td>
                            <td style="text-align: left; margin: 0 auto;">
                                <img src="done payment.png" width="80px" height="45px">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding-right: 20px; padding-left: 10px;">
                </td>
                <td>
                    <table id="summary" border="0" style="padding-left: 40px;">
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
                        <tr>
                            <td>
                                ADDRESS
                            </td>
                            <td colspan="2">
                                Menara TM,<br>
                                Jalan Pantai Baharu, <br>
                                50672 Kuala Lumpur <br>
                                Malaysia
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table id="pay" border="0">
                        <tr>
                            <td colspan="2" style="font-size: 30px; text-align: center;">
                                SCAN QR TO PAY
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                <img src="qr.png" style="width: 200px; height: 200px;"><br>12345678912345
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <form method="post" enctype="multipart/form-data" action="Upload Receipt.php">
                                <button type="submit" name="UPLOAD RECEIPT">Upload Receipt</button>
                                <input type="file" id="receipt" name="receipt" accept="image/*" required>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" value="SUBMIT ORDER">
                                <br>
                                <br>
                                <input type="submit" value="PRINT INVOICE">
                            </td>
                        </tr>
                    </table>
                </td>
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
            //change date
        </script>
	</body>
</html>
	
	
	
