<?php 
	include '../../config/dbconn.php';
	session_start();
	## verify if the session user is admin
	if(isset($_SESSION['username']) && $_SESSION['username'] == "Administrator"){
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Hive4</title>
    <style>
        body{
            background-color: #E6DAD1;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
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
            margin-left: auto;
            margin-right: auto;
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
            border: 1px solid #C7D8CF;
            background-color: #C7D8CF;
        } 
        .sIcon:hover {
            opacity: 0.8;
        }
        #list{
            margin-left: auto;
            margin-right: auto;
            border-spacing: 10px;
            padding-left: 50px;
            background-color:#8AB49C;
            border-radius: 50px;  
            width: 800px;   
            color: #E6DAD1;
            font-size: 20px;
            text-align: left; 
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
        .image {
            object-fit: cover; /* Ensures the image covers the entire container */
        }
    </style>
</head>
<body>
	<table id="header" border="0">
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


    <!--- CUSTOMER --->
    <?php
        if(isset($_POST['submitCustomer'])) {
            //displays search bar customer
            displayCustomerSearchBar();

            include '../../config/dbconn.php';
            $search = mysqli_real_escape_string($dbconn, $_POST['query']);
            $result = getCustomer($search);
            $queryResult = mysqli_num_rows($result);

            if($queryResult > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                displayCustomer($row['User_ID'], $row['User_Name'], $row['Profile_Pic']);
            }
            }
            else {
            echo "<br>";
            echo "<center>There is no result matching your search!</center>";
            }
        }
    ?>

    <!--- PRODUCT --->
    <?php
        if(isset($_POST['submitProduct'])) {
            //displays search bar product
            displayProductSearchBar();

            include '../../config/dbconn.php';
            $search = mysqli_real_escape_string($dbconn, $_POST['query']);
            $result = getProduct($search);
            $queryResult = mysqli_num_rows($result);

            if($queryResult > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $resultStck = getProductStock($row['Product_ID']);
                $productStock = mysqli_fetch_array($resultStck);
                displayProduct($row['Product_Name'], $row['Product_Image'], $productStock[0], $row['Product_ID']);
            }
            }
            else {
            echo "<br>";
            echo "<center>There is no result matching your search!</center>";
            }
        }
    ?>


</body>
</html>

<?php
}else
{	## if the session username is no admin, redirect the page to the login page 
header("Location: admin login.php");
}

//--- CUSTOMER ---
//get customer based on name/id from database
function getCustomer($search){
    include '../../config/dbconn.php';
  
	$sql = "SELECT *
	FROM users
    WHERE User_ID LIKE '%$search%' OR User_Full_Name LIKE '%$search%' AND Type_ID='UT01'";
	$result = mysqli_query($dbconn, $sql);
	return $result;
}

//display customer search bar
function displayCustomerSearchBar(){
    echo '
    <h1 style="text-align: center; color: #8AB49C;">SEARCH CUSTOMER</h1>
    <form id="searchForm" action="search.php" method="POST">
        <table style="width: 800px; border-spacing: 5px;" border="0">
            <tr>
                <td>
                    <table id="bar" border="0">
                        <tr>
                            <td style="text-align: center;">
                                    <input type="text" id="searchInput" name="query" placeholder="Insert customer name or ID" class="searchbar">
                            </td>
                            <td style="text-align: right;">
                                <button type="submit" name="submitCustomer" class="sIcon" style="width: 22px; height: 22px; background: none; border: none; padding: 0; cursor: pointer;">
                                    <img src="search.png" alt="Submit" style="display: inline-block;">
                                </button>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </form>
    <div id="searchResults"></div>
    ';
}

// display customer
function displayCustomer($userId, $userName, $profilePic){
    $user = '
        <br>
        <form id="viewForm" action="admin view user details.php" method="GET">    
        <table id="list"border="0">
        <tr>
        <td rowspan=2  style="width: 54px;"><img src="'.$profilePic.'" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; overflow: hidden;"></td>
        <td style="width: 80px;">username:</td>
        <td>'.$userName.'</td>
        <td rowspan=2 style="width: 120px;">
            <a href="admin view user details.php?userId='.$userId.'"> 
                <b>view</b>
            </a>
        </td>
        </tr>
        <tr>
            <td style="width: 80px;">user ID:</td>
            <td>'.$userId.'</td>
        </tr>
        </table>
    ';
    echo $user;
}

//--- PRODUCT ---
//get product from database
function getProductStock($productId){
    include '../../config/dbconn.php';
  
	$sql = "SELECT SUM(Size_Stock)
	FROM product_size
    WHERE Product_ID='$productId'";
	$result = mysqli_query($dbconn, $sql);
	return $result;
}

///get product based on name/id from database
function getProduct($search){
    include '../../config/dbconn.php';
  
	$sql = "SELECT *
	FROM product
    WHERE Product_ID LIKE '%$search%' OR Product_Name LIKE '%$search%'";
	$result = mysqli_query($dbconn, $sql);
	return $result;
}

//display product search bar
function displayProductSearchBar(){
    echo '
    <h1 style="text-align: center; color: #8AB49C;">SEARCH PRODUCT</h1>
    <form action="search.php" method="POST">
        <table style="width: 800px; border-spacing: 5px;" border="0">
            <tr>
                <td>
                    <table id="bar" border="0">
                        <tr>
                            <td style="text-align: center;">
                                    <input type="text" name="query" placeholder="Insert product name" class="searchbar">
                            </td>
                            <td style="text-align: right;">
                                <button type="submit" name="submitProduct" class="sIcon" style="width: 22px; height: 22px; background: none; border: none; padding: 0; cursor: pointer;">
                                    <img src="search.png" alt="Submit" style="display: inline-block;">
                                </a>
                            </td>
                        </tr>
                    </table>
                </td>
                <!--- ADD PRODUCT --->
                <td style="width: 48px;">
                    <a href="add new product.php">
                        <img src="add new.png">
                    </a>
                </td>
            </tr>
        </table>
    </form>
    ';
}

// display product
function displayProduct($productName, $productPic, $productStock, $productId){
    $product = '
        <br>
        <form id="updateForm" action="" method="GET">
        <table id="list" border="0">
        <tr>
            <td colspan=5>
                <p id="myParagraph" style="display:none; color: red; font-size: 25px; text-align: center;">OUT OF STOCK</p>
            </td>
        </tr>
        <tr>
            <td rowspan=2 style="width: 54px; padding-right: 10px;"><img src="'.$productPic.'" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; overflow: hidden;"></td>
            <td style="width: 150px;">product name</td>
            <td colspan=2>'.$productName.'</td>
            <td style="width: 120px; padding-left:10px;">
                <!-- link to specific product details -->
                <a href="admin update product.php?productId='.$productId.'">
                    <b>update</b>
                </a>
                
            </td>
        </tr>
        <tr>
            <td style="width: 150px;">stock available</td>
            <td style="width: 60px;">'.$productStock.'</td>
            <td>units</td>
            <td><button id="myButton"><b>Out of stock</b></button></td>
        </tr>
        </table>
        </form>
    ';
    echo $product;
}
?>

