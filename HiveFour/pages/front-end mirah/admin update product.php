<?php
include '../../config/dbconn.php';

if (isset($_GET['productId'])) {
    $updateProductId = $_GET['productId'];

    $product = getProduct($updateProductId);
    $rowProduct = mysqli_num_rows($product);

    if ($rowProduct == 0) {
        echo "No record found";
    } else {
        $rProduct = mysqli_fetch_assoc($product);

        $rProdSizeS = mysqli_fetch_assoc(getProductSize($updateProductId, 'S'));
        $rProdSizeM = mysqli_fetch_assoc(getProductSize($updateProductId, 'M'));
        $rProdSizeL = mysqli_fetch_assoc(getProductSize($updateProductId, 'L'));

        $pId = $rProduct['Product_ID'];
        $pName = $rProduct['Product_Name'];
        $pImage = $rProduct['Product_Image'];
        $priceS = $rProdSizeS['Size_Price'];
        $priceM = $rProdSizeM['Size_Price'];
        $priceL = $rProdSizeL['Size_Price'];
        $qtyS = $rProdSizeS['Size_Stock'];
        $qtyM = $rProdSizeM['Size_Stock'];
        $qtyL = $rProdSizeL['Size_Stock'];
    }
}

function getProductSize($productId, $sizeId)
{
    global $dbconn;
    $sql = "SELECT Size_Price, Size_Stock
            FROM product_size
            WHERE Product_ID='$productId'
            AND Size_ID='$sizeId'";
    $result = mysqli_query($dbconn, $sql);
    return $result;
}

function getProduct($productId)
{
    global $dbconn;
    $sql = "SELECT *
            FROM product
            WHERE Product_ID='$productId'";
    $result = mysqli_query($dbconn, $sql);
    return $result;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Hive4</title>
    <style>
        body {
            background-color: #E6DAD1;
            margin: 0;
            padding: 0;
        }
        #acc {
            width: 792px;
            margin-left: auto;
            margin-right: auto;
            background-color: #8AB49C;
            border-radius: 10px;
            padding: 20px;
            font-size: 24px;
            border-spacing: 5px;
        }
        table {
            font-family: calibri, sans-serif;
            color: #E6DAD1;
        }
        input[type="text"], input[type="number"] {
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
        #button {
            width: 500px;
            margin-left: auto;
            margin-right: auto;
            padding-top: 10px;
            border-spacing: 5px;
            text-align: center;
        }
        #header {
            width: 100%;
            background-image: url('header bg pattern.png');
            background-repeat: repeat;
            background-size: contain;
            background-color: #846228;
            padding-left: 10px;
            font-size: 30px;
            color: #E6DAD1;
        }
        a {
            text-align: center;
            color: #E6DAD1;
            text-decoration: none;
        }
        a:hover {
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
<body>
    <table id="header" border="0">
        <tr>
            <th style="padding-left: 20px;">
                <a href="admin users list.php">USERS</a>
            </th>
            <th>
                <a href="admin product list.php">PRODUCTS</a>
            </th>
            <th>
                <a href="admin orders.php">ORDERS</a>
            </th>
            <td colspan=2><img src="design 1.png" style="width:60px; height:60px;"></td>
            <th style="padding-left:60px;">
                <a href="admin dashboard.php">DASHBOARD</a>
            </th>
            <td>
                <a href="admin view account.php">
                    <img src="user.png" style="width:71px; height:40px;" class="user">
                </a>
            </td>
        </tr>
    </table>
    <br><br>
    <form action="update product details process.php" method="POST" enctype="multipart/form-data">
        <table id="acc" border="0">
            <tr>
                <th colspan=5 style="font-size:40px">UPDATE PRODUCT DETAILS</th>
            </tr>
            <tr>
                <td>Product Name</td>
                <td colspan=4>
                    <input type="text" name="pName" value="<?php echo $pName; ?>">
                </td>
            </tr>
            <tr>
                <td>Pricing</td>
            </tr>
            <tr>
                <td>Small</td>
                <td>RM</td>
                <td>
                    <input type="number" name="pSmall" value="<?php echo $priceS; ?>">
                </td>
                <td>Quantity</td>
                <td>
                    <input type="number" name="pSmallQty" value="<?php echo $qtyS; ?>">
                </td>
            </tr>
            <tr>
                <td>Medium</td>
                <td>RM</td>
                <td>
                    <input type="number" name="pMed" value="<?php echo $priceM; ?>">
                </td>
                <td>Quantity</td>
                <td>
                    <input type="number" name="pMedQty" value="<?php echo $qtyM; ?>">
                </td>
            </tr>
            <tr>
                <td>Large</td>
                <td>RM</td>
                <td>
                    <input type="number" name="pLarge" value="<?php echo $priceL; ?>">
                </td>
                <td>Quantity</td>
                <td>
                    <input type="number" name="pLargeQty" value="<?php echo $qtyL; ?>">
                </td>
            </tr>
            <tr>
                <td>Image</td>
                <td colspan="4">
                    <input type="file" name="image" accept="image/*">
                    <span style="font-size: 15px; font-style: italic;"> File type: .jpg, .jpeg, & .png only & max 10MB </span>
                </td>
            </tr>
            <input type="hidden" name="pId" value="<?php echo $pId; ?>">
            <tr>
                <td colspan="5">
                    <table id="button" border="0">
                        <tr>
                            <td>
                                <button type="submit" name="update" style="background: none; border: none; padding: 0; cursor: pointer;">
                                    <img src="publish.png" alt="Submit" value="update" style="display: inline-block;">
                                </button>
                            </td>
                            <td>
                                <a href="admin product list.php">
                                    <input type="image" src="out of stock.png" alt="out of stock">
                                </a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
