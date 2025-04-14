<?php 
	include '../../config/dbconn.php';
	session_start();
	## verify if the session user is admin
	if(isset($_SESSION['username']) && $_SESSION['username'] == "Administrator"){
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="update" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Products</title>
    <style>
        body{
            background-color: #E6DAD1;
            font-family:calibri, sans-serif;
            margin: 0;
			padding: 0;
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
        /*#myButton{
            background-color: #8AB49C;
            border: 1px solid #8AB49C;
            color: #E6DAD1;
            font-family:calibri, sans-serif;
            font-size: 20px;
            text-align: left;
        }*/
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
<?php include 'admin header.php'; ?>
<body>
    <!--- SEARCH PRODUCT --->
    <h1 style="text-align: center; color: #8AB49C;">SEARCH PRODUCT</h1>
        <table style="width: 800px; border-spacing: 5px;" border="0">
            <tr>
                <td>
                <form action="search.php" method="POST">
                    <table id="bar" border="0">
                        <tr>
                            <td style="text-align: center;">
                                    <input type="text" name="query" placeholder="Insert product name or ID" class="searchbar">
                            </td>
                            <td style="text-align: right;">
                                <button type="submit" name="submitProduct" class="sIcon" style="width: 22px; height: 22px; background: none; border: none; padding: 0; cursor: pointer;">
                                    <img src="search.png" alt="Submit" style="display: inline-block;">
                                </button>
                            </td>
                        </tr>
                    </table>
                </form>
                </td>
    <!--- ADD PRODUCT --->
                <td style="width: 48px;">
                    <a href="add new product.php">
                        <img src="add new.png">
                    </a>
                </td>
    <!--- UPDATE PRICE --->
                <td style="width: 48px;">
                    <form action="update price.php" method="POST">
                        <p style="text-align: center;">
                            <button type="submit" name="update" style="display: inline-block; padding: 10px 20px; background-color: #8AB49C; color: white; border-radius: 10px; font-size: 13px; border: none; cursor: pointer;">UPDATE PRICE</button>
                        </p>
                    </form>
                </td>
            </tr>        
        </table>
    <!--- PRODUCT LIST --->
    <?php
        $result = getProduct();
        while ($row = mysqli_fetch_assoc($result)) {
        displayProduct($row['Product_Name'], $row['Product_Image'], $row['Product_Status_ID'], $row['Product_ID']);
        }
    ?>
</body>
</html>

<?php
} 
Else
{	## if the session username is no admin, redirect the page to the login page 
header("Location: ../../pages/customer/login.php");
}

// get products from database
function getProduct(){
    include '../../config/dbconn.php';
  
	$sql = "SELECT *
	FROM product";
	$result = mysqli_query($dbconn, $sql);
	return $result;
}

// display product
function displayProduct($productName, $productPic, $prodStatus, $productId){
    echo'
        <br>
        <form id="updateForm" action="" method="GET">
        <table id="list" border="0">
        ';
        if($prodStatus == 'PDS2'){ // checking if product status is unavailable, the unavailable will be displayed
            echo '
            <tr>
            <td colspan=5>
            <p style="text-align: center;">
                <span style="display: inline-block; padding: 10px 20px; background-color: red; color: white; border-radius: 10px; font-size: 18px;">UNAVAILABLE</span>
            </p>
            </td>
            </tr>';
        }
        echo'
        <tr>
            <td style="width: 54px; padding-right: 10px;"><img src="'.$productPic.'" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; overflow: hidden;"></td>
            <td>'.$productName.'</td>
            <td rowspan=2 style="width: 120px; padding-left:25px;">
                <!-- link to specific product details -->
                <a href="admin update product.php?productId='.$productId.'">
                    <b>update</b>
                </a> 
            </td>
        </tr>
        </table>
        </form>
    ';
}
?>
