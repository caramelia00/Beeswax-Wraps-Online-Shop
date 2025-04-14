<?php
	include '../../config/dbconn.php';

	session_start();
	
	$session = $_SESSION['User_ID'];
	if (empty($session)) {
		header("Location: login.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
	<title>Checkout</title>
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
                font-family:calibri, sans-serif;
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
            #list{
                margin-left: auto;
                margin-right: auto;
                padding-top: 10px;
                padding-bottom: 10px;
                padding-right: 50px;
                padding-left: 50px;
                background-color:#8AB49C;
                border-radius: 50px;   
                width: 800px;   
                text-align: left; 
                font-size: 20px;
                color: #E6DAD1;
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
    <?php include 'customer header.php'; ?>
	<body>
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
                    <form method="POST" enctype="multipart/form-data" action="checkout process.php">
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

                        <?php
                            $total = 0;
                            if(!empty($_SESSION['cart'])) {
                            foreach($_SESSION['cart'] as $keys => $value) {
                                $total = $total + ($value['price'] * $value['quantity']);
                        ?>
                                <tr>
                                    <td rowspan="3" style="width: 54px; padding-right: 10px;">
                                        <img src="<?php echo $value['productImg'] ?>" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; overflow: hidden;">
                                    </td>
                                    <td colspan="2">
                                        <input type="hidden" name="pId" value="<?php echo $value['productId']; ?>">
                                        <?php echo $value['productName']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input type="hidden" name="sId" value="<?php echo $value['sizeId']; ?>">
                                        Size: <?php echo $value['sizeId']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="hidden" name="qty" value="<?php echo $value['quantity']; ?>">
                                        X<?php echo $value['quantity']; ?>
                                    </td>
                                    <td style="text-align: right;">
                                        RM<?php echo $value['price']; ?>
                                    </td>
                                </tr>
                            <?php
                            }
                            }
                            ?>   
                        <tr>
                            <td>
                                Items Subtotal
                            </td>
                            <td colspan="2">
                                RM<?php echo $total; ?>
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
                                RM<?php echo $total+5; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ADDRESS
                            </td>
                            <?php 
                                $uId = $_SESSION['User_ID'];
                                $uDetails = getUserDetails($uId);
                                $rUser = mysqli_fetch_assoc($uDetails);

                                $uAddress1 = $rUser['Address1'];
                                $uAddress2 = $rUser['Address2'];
                                $postcode = $rUser['Postcode'];
                                $state = $rUser['State'];
                                $city = $rUser['City'];

                            ?>
                            <td colspan="2">
                            <?php echo $uAddress1; ?>,<br>
                            <?php if($uAddress2 != 'NULL') echo $uAddress2 . ',<br>'; ?>
                            <?php echo $postcode; ?> <?php echo $city; ?>, <br>
                            <?php echo $state; ?>
                            </td>
                        </tr>
                    </table>
                <td>
                    <table id="pay" border="0">
                        <tr>
                            <td colspan="2" style="font-size: 30px; text-align: center;">
                                SCAN QR TO PAY
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                <img src="qr bank.png" style="width: 200px; height: 200px;"><br>12345678912345
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <input type="file" id="receipt" name="receipt" accept="image/*" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="submitOrder" value="SUBMIT ORDER">
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        </form>
        <br>
	</body>
</html>
<?php 
    function getUserDetails($uId){
        include '../../config/dbconn.php';
      
        $sql = "SELECT *
        FROM users
        JOIN user_details on user_details.User_ID = users.User_ID
        WHERE users.User_ID='$uId'";
        $result = mysqli_query($dbconn, $sql);
        return $result;
    }
?>
	
	
	
