<?php
    session_start();
    
    $session = $_SESSION['User_ID'];
    if (empty($session)) {
    header("Location: login.php");
    exit();
    }

    if(isset($_POST['remove'])) {
        $productIdToRemove = $_POST['productId'];
        $sizeIdToRemove = $_POST['sizeId']; // Add this line to get the size ID

        foreach($_SESSION['cart'] as $key => $value) {
            if($value['productId'] == $productIdToRemove && $value['sizeId'] == $sizeIdToRemove) {
                unset($_SESSION['cart'][$key]);
                echo '
                    <script>
                        alert("Product has been removed from cart");
                    </script>
                ';
            }
        }
    }
?>

<!DOCTYPE html> 
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <style>
        body{
            margin:0;
        }
        body{
            background-color: #E6DAD1;
            font-family:calibri, sans-serif;
        }
        #bar{
            width: 100%;
            background-color: #C7D8CF;
            border-radius: 30px;
            color: #8AB49C;
            padding-left: 10px;
            padding-right: 10px;
        }
        table{
            margin-left: auto;
            margin-right: auto;
        }
        .searchbar{
            height: 20px;
            
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
        .sIcon{
            background-color: #C7D8CF;
            border: 1px solid #C7D8CF;
        }
        .sIcon:hover {
            opacity: 0.8;
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
        #product_btns{
            text-align: right; 
            display: inline-block;
            padding: 5px 10px;
            font-size: 14px;
            font-weight: bold;
            color: #9D5A4D;
            background-color: #C30D23;
            border: none;
            border-radius: 30px;
            cursor: pointer;
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
                border: 1px solid #E6DAD1;
                background-color: #E6DAD1;
                border-radius: 10px;
                box-sizing: border-box;
                margin-bottom: 10px;
		}
         /* Style the dropdown container */
        .custom-select {
            position: relative;
            display: inline-block;
            width: 150px;
            margin-bottom: 10px;
        }

        /* Style the dropdown menu */
        .custom-select select {
            display: block;
            width: 100%;
            font-size: 14px;
            line-height: 1.5;
            color: #555;
            background-color: #E6DAD1;
            border: 1px solid #E6DAD1;
            border-radius: 7px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        /* Style the dropdown arrow */
        .custom-select::after {
            content: "";
            position: absolute;
            top: 50%;
            right: 10px;
            width: 0;
            height: 0;
            border-top: 6px solid #555;
            border-right: 6px solid transparent;
            border-left: 6px solid transparent;
        }
        .checkout-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: bold;
            color: #9D5A4D;
            background-color: white;
            border: none;
            border-radius: 30px;
            cursor: pointer;
        }
        .checkout-button:hover{
            background-color: #8AB49C;
        }
        .back-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: bold;
            color: #9D5A4D;
            background-color: white;
            border: none;
            border-radius: 30px;
            cursor: pointer;
        }
        .back-button:hover{
            background-color: #8AB49C;
        }
    </style>
</head>
<body>
<?php
    if(isset($_GET['productremoved'])) {
      echo '
        <script>
            alert("Product has been removed from cart.");
        </script> 
      ';
    }
    ?>
    <?php include 'customer header.php'; ?>
    <h1 style="text-align: center; color: #8AB49C;">SHOPPING CART</h1>
    <br>
    <table>
        <tr>
            <td style="text-align: left; padding-right: 400px;">
	            <label for="amount"><b style="color: #8AB49C; font-size: 25px;">
                <?php
                  if(isset($_SESSION['cart'])) {
                    $count = count($_SESSION['cart']);
                    echo '<b>( '.$count.' ) ITEMS</b>';
                  }
                  else {
                    echo '<b>( 0 ) ITEMS</b>';
                  }
                  ?>
                </b></label>
            </td>
            <td style="padding-left: 400px;">
            </td>
        </tr>
    </table>
    <table style="width: 60%;">
        <tr>
            <td>
            <?php

              $total = 0;
              if(!empty($_SESSION['cart'])) {
                foreach($_SESSION['cart'] as $keys => $value) {
                  cartElement($value['productImg'],$value['productName'],$value['price'],$value['productId'],$value['sizeId'],$value['quantity']);
                  $total = $total + ($value['price'] * $value['quantity']);
                }
              }
              else {
                echo '<div style="text-align: center;margin-top: 5rem;margin-bottom: 5rem">';
                echo '<p>You have no item(s) in cart!</p>';
                echo '<p>Back to <strong><a href="search product.php" style="color: orange">Products</a></strong></p>';
                echo '</div>';
              }

              ?>
        </td>
    </tr>
    </table>
    <br>
    <?php if($total != 0){ ?>
    <table>
        <tr>
            <td>
                <a href="checkout.php">
                <button type="button" class="checkout-button">Check Out</button></a>
            </td>
        </tr>
    </table>
    <?php } ?>
</body>
</html>
<?php 
    function cartElement($productImg, $productName, $price, $productId, $sizeId, $quantity) {
        $element = '
        <form action="" method="post" class="product_wrap">
            <table id="list" border="0">
                <tr>
                    <td rowspan=3 style="width: 54px; padding-right: 10px;"><img src="'.$productImg.'" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; overflow: hidden;"></td>
                    <td style="width: 150px;">Product Name</td>
                    <td colspan=3>'.$productName.'</td>
                    <input type="hidden" name="productId" value="'.$productId.'">
                </tr>
                <tr>
                    <td style="width: 150px;">Quantity</td>
                    <td>'.$quantity.'</td>
                </tr> 
                <tr>
                    <td style="width: 60px;">Size</td>
                    <input type="hidden" name="sizeId" value="'.$sizeId.'">
                    <td>'.$sizeId.'</td>
                    <td style="text-align: right;">
                        <button type="submit" name="remove" style="background-color: #C30D23; color: white; border: none; border-radius: 15px; cursor: pointer; padding: 5px 10px; font-size: 12px; font-weight: bold;">REMOVE</button>
                    </td>
                </tr>
            </table>
        </form>
        <br>
        ';
        echo $element;
      }
?>
