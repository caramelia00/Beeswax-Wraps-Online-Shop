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
    <title>Users</title>
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
    </style>
</head>
<?php include 'admin header.php'; ?>
<body>
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
    <?php
        $result = getAllCustomers();
        while ($row = mysqli_fetch_assoc($result)) {
        displayCustomer($row['User_ID'], $row['User_Name'], $row['Profile_Pic']);
        }
    ?>
</body>
</html>

<?php
}else
{	## if the session username is no admin, redirect the page to the login page 
header("Location: ../../pages/customer/login.php");
}

// get customers from database
function getAllCustomers(){
    include '../../config/dbconn.php';
  
	$sql = "SELECT *
	FROM users
    WHERE Type_ID='UT01'";
	$result = mysqli_query($dbconn, $sql);
	return $result;
}

// display customer
function displayCustomer($userId, $userName, $profilePic){
    $user = '
        <br>
        <form id="viewForm" action="" method="GET">    
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
        </form>
        </table>
    ';
    echo $user;
}
?>
