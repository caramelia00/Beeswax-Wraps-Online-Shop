<?php
    include '../../config/dbconn.php';

    session_start();
    
    $session = $_SESSION['User_ID'];
    if (empty($session)) {
        header("Location: login.php");
        exit();
    }
    
    if (isset($_GET['productId'])) {
        $pId = $_GET['productId'];
    
        $product = getProduct($pId);
        $rowProduct = mysqli_num_rows($product);
    
        if ($rowProduct == 0) {
            echo "No record found";
        } else {
            $rProduct = mysqli_fetch_assoc($product);
    
            $pName = $rProduct['Product_Name'];
            $pImage = $rProduct['Product_Image'];
            $pStatus = $rProduct['Product_Status_ID'];
        }

        if (isset($_POST['addToCart'])) {
            $sIdSelect = $_POST['sizeId'];
            $quantity = $_POST['quantity'];

            if (isset($_SESSION['cart'])) {
                $item_exists = false;
                foreach ($_SESSION['cart'] as $key => $item) {
                    if ($item['productId'] == $pId && $item['sizeId'] == $sIdSelect) {
                        $_SESSION['cart'][$key]['quantity'] += $quantity;
                        $item_exists = true;
                        break;
                    }
                }
                if (!$item_exists) {
                    $sizeSelect = getSizeOnId($sIdSelect);
                    $rSize = mysqli_fetch_assoc($sizeSelect);
                    $sName = $rSize['Size_Name'];
                    $sPrice = $rSize['Size_Price'];
        
                    $item_array = array(
                        'productId' => $pId,
                        'productName' => $pName,
                        'productImg' => $pImage,
                        'price' => $sPrice,
                        'sizeId' => $sIdSelect,
                        'sizeName' => $sName,
                        'quantity' => $quantity,
                    );
        
                    $_SESSION['cart'][] = $item_array;
                }
            } else {
                $sizeSelect = getSizeOnId($sIdSelect);
                $rSize = mysqli_fetch_assoc($sizeSelect);
                $sName = $rSize['Size_Name'];
                $sPrice = $rSize['Size_Price'];
        
                $item_array = array(
                    'productId' => $pId,
                    'productName' => $pName,
                    'productImg' => $pImage,
                    'price' => $sPrice,
                    'sizeId' => $sIdSelect,
                    'sizeName' => $sName,
                    'quantity' => $quantity,
                );
        
                $_SESSION['cart'][] = $item_array;
            }
            header("Location: cart.php");
            exit();
        }
        
        if (isset($_POST['unavailable'])) {
            echo "<script>
                alert('Product is unavailable!');
            </script>"; 
        }
    }
?>
<!DOCTYPE html>
<html>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">
	<title>Product Details</title>
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
			.zoom-effect {
				overflow: hidden;
				position: relative;
				border-radius: 5%;
			}

			.zoom-effect:hover img {
				transform: scale(3); /* Increase the scale to zoom in (1.2 means 120% of original size) */
				transition: transform 0.3s; /* Add a smooth transition effect */
			}
		</style>
	</head>
	<?php include 'customer header.php'; ?>
	<body>
	<script>
		// Ensure that at least one option is selected
		document.getElementById('sizeForm').addEventListener('submit', function(e) {
			let radios = document.getElementsByName('sizeId');
			let selected = false;
			for (let radio of radios) {
				if (radio.checked) {
					selected = true;
					break;
				}
			}
			if (!selected) {c
				radios[0].checked = true;
			}
		});
	</script>
	<form action="" method="POST">
	<table id=low border="0">
		<tr>
			<td colspan=3>
				<table id=b border="0">
					<tr>
						<td colspan=2>
							<table id=ord border="0">
								<tr>
									<td class="zoom-effect">
										<img src="<?php echo $pImage?>" name="productImg" style="width: 400px; height: 400px; border-radius: 5%">
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
                        <td>
                            <input type="hidden" name="pId" value="<?php echo htmlspecialchars($pId); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td name="productName" style="text-align:left; font-size:50px;"><?php echo htmlspecialchars($pName); ?></td>
                    </tr>
					<tr>
						<td>
							<b>SIZE</b>
							<?php
								$size = getSize();
								$isFirst = true; // Variable to track the first iteration

								while ($r = mysqli_fetch_assoc($size)) {
									displaySize($r['Size_ID'], $r['Size_Name'], $r['Size_Description'], $r['Size_Price'], $isFirst);
									$isFirst = false; // Set $isFirst to false after the first iteration
								}
							?>
						</td>
					</tr>
					<tr>
						<td><b>QUANTITY</b>
							<br><input type="number" name="quantity" min="1" max="1000" value="1">
						</td>
					</tr>
					<tr>
						<td>
							<?php if($pStatus =='PDS1'){ ?>
								<input type="submit" name="addToCart" value="ADD TO CART">
							<?php }else{ ?>
								<input type="submit" name="unavailable" VALUE="UNAVAILABLE">
							<?php }?>
							<!-- <a href="search product.php"><input type="submit" value="BACK"></a> -->
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	</form>
	</body>
</html><?php
	function displaySize($sId, $sName, $sDesc, $sPrice, $isSelected){
		echo '
			<br>
			<input type="radio" id="size_' . htmlspecialchars($sId) . '" name="sizeId" value="' . htmlspecialchars($sId) . '"' . ($isSelected ? ' checked' : '') . '>
			<label for="size_' . htmlspecialchars($sId) . '">
				' . htmlspecialchars($sName) . ' - ' . htmlspecialchars($sDesc) . ' (RM' . htmlspecialchars($sPrice) . ')
			</label>
			<br>';
	}
	function getProduct($pId){
		global $dbconn;
		$sql = "SELECT *
				FROM product
				WHERE Product_ID = '$pId'";
		$result = mysqli_query($dbconn, $sql);
		return $result;
	}

	function getSize(){
		global $dbconn;
		$sql = "SELECT *
				FROM size";
		$r = mysqli_query($dbconn, $sql);
		return $r;
	}

	function getSizeOnId($sizeId){
		global $dbconn;
		$sql = "SELECT *
				FROM size
				WHERE Size_ID ='$sizeId'";
		echo $sql;
		$r = mysqli_query($dbconn, $sql);
		return $r;
	}
?>

