<?php
//--->get app url > start

if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $ssl = 'https';
}
else {
  $ssl = 'http';
}
 
$app_url = ($ssl  )
          . "://".$_SERVER['HTTP_HOST']
          //. $_SERVER["SERVER_NAME"]
          . (dirname($_SERVER["SCRIPT_NAME"]) == DIRECTORY_SEPARATOR ? "" : "/")
          . trim(str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"])), "/");

//--->get app url > end

header("Access-Control-Allow-Origin: *");

//-------------------------------------------------

session_start();
include '../../config/dbconn.php';

if (isset($_GET['orderId'])) {
	$oId = $_GET['orderId'];

	//TO GENERATE INVOICE NUMBER
	if(empty($oId)) {
	$number = "#00001";
	}
	else {
	$numericPart = intval(substr($oId, 1));
	$idd = str_replace("#","",$numericPart);
	$id = str_pad($idd,5,0,STR_PAD_LEFT);
	$number = '#' .$id;
	}
}

function getOrders($orderId)
{
    global $dbconn;
    $sql = "SELECT *
            FROM orders
            JOIN order_details on order_details.Order_ID = orders.Order_ID
            JOIN status on status.Status_ID = orders.Status_ID
            JOIN users on users.User_ID = orders.User_ID
            JOIN user_details on user_details.User_ID = users.User_ID
            WHERE orders.Order_ID='$orderId'";
    $result = mysqli_query($dbconn, $sql);
    return $result;
}

function getOrderDetails($orderId){
    global $dbconn;
    $sql = "SELECT *
            FROM order_details
            JOIN orders on orders.Order_ID = order_details.Order_ID
            JOIN product on product.Product_ID = order_details.Product_ID
            JOIN size on size.Size_ID = order_details.Size_ID
            WHERE orders.Order_ID='$orderId'";
    $result = mysqli_query($dbconn, $sql);
    return $result;
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>HiveFour | Receipt</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="description" content="This ">

	<meta name="author" content="Code With Mark">
	<meta name="authorUrl" content="http://codewithmark.com">

	<!--[CSS/JS Files - Start]-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script> 

	<script src="<?php echo $app_url?>/af.min.js"></script> 
  
 	<style>
	.invoice-box {
		max-width: 800px;
		margin: auto;
		padding: 30px;
		border: 1px solid #eee;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
		font-size: 16px;
		line-height: 24px;
		font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
		color: #555;
	}

	.invoice-box table {
		width: 100%;
		line-height: inherit;
		text-align: left;
	}

	.invoice-box table td {
		padding: 5px;
		vertical-align: top;
	}

	.invoice-box table tr td:nth-child(2) {
		text-align: right;
	}

	.invoice-box table tr.top table td {
		padding-bottom: 20px;
	}

	.invoice-box table tr.top table td.title {
		font-size: 45px;
		line-height: 45px;
		color: #333;
	}

	.invoice-box table tr.information table td {
		padding-bottom: 40px;
	}

	.invoice-box table tr.heading td {
		background: #eee;
		border-bottom: 1px solid #ddd;
		font-weight: bold;
	}

	.invoice-box table tr.details td {
		padding-bottom: 20px;
	}

	.invoice-box table tr.item td {
		border-bottom: 1px solid #eee;
	}

	.invoice-box table tr.item.last td {
		border-bottom: none;
	}

	.invoice-box table tr.total td:nth-child(2) {
		border-top: 2px solid #eee;
		font-weight: bold;
	}

	@media only screen and (max-width: 600px) {
		.invoice-box table tr.top table td {
			width: 100%;
			display: block;
			text-align: center;
		}

		.invoice-box table tr.information table td {
			width: 100%;
			display: block;
			text-align: center;
		}
	}

	/** RTL **/
	.invoice-box.rtl {
		direction: rtl;
		font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
	}

	.invoice-box.rtl table {
		text-align: right;
	}

	.invoice-box.rtl table tr td:nth-child(2) {
		text-align: left;
	}
	</style>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" ></script>

	<script type="text/javascript">
	$(document).ready(function($) 
	{ 
		$(document).on('click', '.btn_print', function(event) 
		{
			event.preventDefault();

			//credit : https://ekoopmans.github.io/html2pdf.js
			
			var element = document.getElementById('container_content'); 
			var invoiceId = "<?php echo $number; ?>";

			//more custom settings
			var opt = 
			{
			  margin:       1,
			  filename:     invoiceId+js.AutoCode()+'.pdf',
			  image:        { type: 'jpeg', quality: 0.98 },
			  html2canvas:  { scale: 2 },
			  jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
			};
			// New Promise-based usage:
			html2pdf().set(opt).from(element).save();	 
		});
	});
	</script>

</head>
<body>

<div class="text-center" style="padding:20px;">
	<input type="button" id="rep" value="Print" class="btn btn-info btn_print" style="background-color: orange;">
</div>

<div class="container_content" id="container_content" >	

		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0" >
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<img src="<?php echo $app_url?>/design 1.png" style="width: 80px; max-width: 80px" />
								</td>
								<td>
									<?php
									date_default_timezone_set('Asia/Kuala_Lumpur');
									$date = date("Y-m-d");
									$time = date("h:i:s");
									?>
									Receipt: <?php echo $number?><br />
									Created: <?php echo $date?><br />
									Time: <?php echo $time?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									HiveFour Beeswax Wraps<br/>
									hive4@gmail.com<br/>
									Suite 15, Level 10,<br>
									KL Eco City,<br>
									59200 Kuala Lumpur,<br>
									WP Kuala Lumpur
								</td>
								<td>
									<?php 
										$order = getOrders($oId);
										$rOrder = mysqli_fetch_assoc($order);
										
										$uEmail = $rOrder['User_Email'];
										$uFullName = $rOrder['User_Full_Name'];
										$uAddress1 = $rOrder['Address1'];
										$uAddress2 = $rOrder['Address2'];
										$postcode = $rOrder['Postcode'];
										$state = $rOrder['State'];
										$city = $rOrder['City'];
										$phoneNo = $rOrder['Phone_No'];
									?>
									<?php echo $uFullName; ?><br />
									<?php echo $uEmail; ?> <br>
									<?php echo $uAddress1; ?>,<br>
                                    <?php if($uAddress2 != 'NULL') echo $uAddress2 . ',<br>'; ?>
                                    <?php echo $postcode; ?> <?php echo $city; ?>, <br>
                                    <?php echo $state; ?> <br>
									<?php echo $phoneNo; ?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class="heading">
					<td>Item</td>
					<td>Price</td>
				</tr>
				<?php 
					$orderDetails = getOrderDetails($oId);
					$totPrice=0;
					if (mysqli_num_rows($orderDetails) > 0) {
						while ($rOrdDetails = mysqli_fetch_assoc($orderDetails)) {
							$itemTotalPrice = $rOrdDetails['Size_Price'] * $rOrdDetails['Quantity'];
							$totPrice += $itemTotalPrice;
				?>
							<tr class="item">
								<td><?php echo $rOrdDetails['Product_Name']; ?> - <?php echo $rOrdDetails['Size_ID']; ?> x<?php echo $rOrdDetails['Quantity']; ?> </td>
								<td>RM<?php echo number_format($rOrdDetails['Size_Price'], 2);?> </td>
							</tr>
				<?php 
						}
					}
				?>
				<tr class="item last">
					<td>Shipping Fee</td>
					<td>RM5.00</td>
				</tr>
				<tr class="total">
					<td></td>
					<td>Total: RM<?php echo number_format($totPrice+5, 2);?></td>
				</tr>
			</table>
		</div>
</div>
</body>
</html>