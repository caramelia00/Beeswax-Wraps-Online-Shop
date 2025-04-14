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
    <title>Search</title>
    <style>
        body{
            background-color: #E6DAD1;
            font-family:calibri, sans-serif;
            margin: 0;
			padding: 0;    
        }
        #one{
            width: 800px;
            font: 24px;
            }
        #five{
            margin-left: auto;
            margin-right: auto;
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
        #three{
                width: 100%;
                padding: 10px;
                background-color:#8AB49C;
                border-radius: 40px;
                color: #E6DAD1;
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
        #button{
            text-align: center;
            background-color: #8AB49C;
            border: 1px solid #8AB49C;
            color: #E6DAD1;
            font-size: 24px;
            text-decoration: none;
            cursor: pointer;
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
    <script>
        function confirmDeletion(orderId) {
            var userConfirmation = confirm("Are you sure you want to delete this order?");
            if (userConfirmation) {
                window.location.href = 'delete order process.php?orderId=' + orderId;
            }
        }
        </script>
</head>
<body>
<?php include 'admin header.php'; ?>

    <?php
        include '../../config/dbconn.php';
        //--- CUSTOMER ---
        if(isset($_POST['submitCustomer'])) {
            displayCustomerSearchBar();

            $search = mysqli_real_escape_string($dbconn, $_POST['query']);
            if($search==""){
                echo "<script>alert('Enter query!'); 
                    window.location.href = 'admin users list.php';
                    </script>";
                exit();
            }
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
        } //--- PRODUCT ---
        else if(isset($_POST['submitProduct'])) {
            displayProductSearchBar();

            $search = mysqli_real_escape_string($dbconn, $_POST['query']);
            if($search==""){
                echo "<script>alert('Enter query!'); 
                    window.location.href = 'admin product list.php';
                    </script>";
                exit();
            }
            $result = getProduct($search);
            $queryResult = mysqli_num_rows($result);

            if($queryResult > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    displayProduct($row['Product_Name'], $row['Product_Image'], $row['Product_Status_ID'], $row['Product_ID']);
                }
            }
            else {
            echo "<br>";
            echo "<center>There is no result matching your search!</center>";
            }
        } //--- ORDER ---
        else if (isset($_POST['submitOrder'])) {
            displayOrderSearchBar();
        
            $search = mysqli_real_escape_string($dbconn, $_POST['query']);
            if($search==""){
                echo "<script>alert('Enter query!'); 
                    window.location.href = 'admin orders.php';
                    </script>";
                exit();
            }
            $result = getOrders($search);
            
            if ($result) { // Check if the query was successful
                $queryResult = mysqli_num_rows($result);
        
                if ($queryResult > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $orderDetails = generateOrderDetailsHtml($row['Order_ID']);
                        $orderDetailsHtml = $orderDetails['html'];
                        $shipPrice = 5;
                        $orderTotalPrice = $orderDetails['total_price'] + $shipPrice;
        
                        displayOrders($row['Order_ID'], $row['Status_Name'], $row['Size_Price'], $orderTotalPrice, $orderDetailsHtml);
                    }
                } else {
                    echo "<br>";
                    echo "<center>There is no result matching your search!</center>";
                }
            } else {
                echo "Error: " . mysqli_error($dbconn); // Output the error message if the query fails
            }
        } 
    ?>
</body>
</html>

<?php
}else
{	## if the session username is no admin, redirect the page to the login page 
header("Location: ../../pages/customer/login.php");
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
                                    <input type="text" name="query" placeholder="Insert product name or ID" class="searchbar">
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
function displayProduct($productName, $productPic, $prodStatus, $productId){
    echo'
        <br>
        <form id="updateForm" action="" method="GET">
        <table id="list" border="0">
        ';
        if($prodStatus == 'PDS2'){ // checking if product status is unavailable
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
                <a href="admin update product.php?productId='.$productId.'">
                    <b>update</b>
                </a> 
            </td>
        </tr>
        </table>
        </form>
    ';
}

//--- ORDER ---

//get order details from database
function getOrderDetails($orderId){
    include '../../config/dbconn.php';

    $sql = "SELECT *
    FROM order_details
    JOIN product ON product.Product_ID = order_details.Product_ID
    JOIN size ON size.Size_ID = order_details.Size_ID
    WHERE order_details.Order_ID='$orderId'";
    $result = mysqli_query($dbconn, $sql);
    return $result;
}
//get order/product based on name/id from database
function getOrders($search){
    include '../../config/dbconn.php';

    $query = "SELECT * 
    FROM orders
    JOIN status on status.Status_ID = orders.Status_ID
    JOIN users on users.User_ID = orders.User_ID
    JOIN order_details on order_details.Order_ID = orders.Order_ID
    JOIN product on product.Product_ID = order_details.Product_ID
    JOIN size on size.Size_ID = order_details.Size_ID
    WHERE orders.Payment_Receipt <> ''
    AND (orders.Order_ID LIKE '%$search%' OR product.Product_Name LIKE '%$search%' 
    OR users.User_Full_Name LIKE '%$search%' OR status.Status_Name LIKE '%$search%')";
    $result = mysqli_query($dbconn, $query);
    return $result;
}

//display order search bar
function displayOrderSearchBar(){
    echo '
	<h1 style="text-align: center; color: #8AB49C;">SEARCH ORDER</h1>
    <table id="one" style="border-spacing: 5px;" border="0">
        <tr>
            <td>
                <table id="bar" border="0">
                    <form action="search.php" method="POST">
                        <tr>
                            <td style="text-align: center;">
                                <input type="text" name="query" placeholder="Insert order ID, order status, customer name, product name" class="searchbar">
                            </td>
                            <td style="text-align: right;">
                                <button type="submit" name="submitOrder" class="sIcon" style="width: 22px; height: 22px; background: none; border: none; padding: 0; cursor: pointer;">
                                    <img src="search.png" alt="Submit" style="display: inline-block;">
                                </button>
                            </td>
                        </tr>
                    </form>
                </table>
            </td>
        </tr>
    </table>
    ';
}

//generate order details for HTML
function generateOrderDetailsHtml($orderId) {
    $orderDetails = getOrderDetails($orderId);
    $detailsHtml = '';
    $totPrice=0;

    if (mysqli_num_rows($orderDetails) > 0) {
        while ($rOrdDetails = mysqli_fetch_assoc($orderDetails)) {
            $itemTotalPrice = $rOrdDetails['Size_Price'] * $rOrdDetails['Quantity'];
            $totPrice += $itemTotalPrice;
            $detailsHtml .= '
            <table id="three" border="0">
                <tr>
                    <td id="img" rowspan="2"><img src="' . htmlspecialchars($rOrdDetails['Product_Image']) . '" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; overflow: hidden;"></td>
                    <td id="name">' . htmlspecialchars($rOrdDetails['Product_Name']) . '</td>
                    <td rowspan="2">x' . htmlspecialchars($rOrdDetails['Quantity']) . '</td>
                    <td rowspan="2">RM' . htmlspecialchars($rOrdDetails['Size_Price']) . '</td>
                </tr>
                <tr>
                    <td style="vertical-align: text-top;">Size: ' . htmlspecialchars($rOrdDetails['Size_ID']) . '</td>
                </tr>
            </table>';
        }
    } else {
        $detailsHtml .= '<tr><td colspan="4">No order details found.</td></tr>';
    }
    return ['html' => $detailsHtml, 'total_price' => $totPrice];
}

// display order
function displayOrders($orderId, $orderStatus, $orderPrice, $orderTotalPrice, $orderDetailsHtml) {
            echo '
            <br>
            <tr>
                <td colspan="2">
                    <table id="list" border="0">
                        <tr>
                            <td colspan="2" style="width: 150px; padding-left: 10px;"><b>Order ID: </b>' . htmlspecialchars($orderId) . '</td>
                            <td style="text-align: center;">
                                <a href="receipt.php?orderId=' . htmlspecialchars($orderId) . '" target="_blank" style="display: inline-block; padding: 7px 12px; background-color: white; color: #8AB49C; border-radius: 10px; font-size: 12px; border: none; cursor: pointer;">
                                    RECEIPT
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">' . $orderDetailsHtml . '</td>
                            <td rowspan="2">
                                <b>' . htmlspecialchars($orderStatus) . '</b><br>
                                Total Payment<br>
                                RM' . htmlspecialchars($orderTotalPrice) . '
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <table id="five" border="0">
                                    <tr>
                                        <td style="padding-bottom: 4px;">
                                            <a id=button href="admin order details.php?orderId=' . htmlspecialchars($orderId) . '">
                                                <b>VIEW</b>
                                            </a>                                        
                                        </td>
                                        <td style="padding-bottom: 4px;">
                                        <button onclick="confirmDeletion(\'' . htmlspecialchars($orderId) . '\')" id="button">
                                            <b>DELETE</b>
                                        </button>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>';
        }
?>