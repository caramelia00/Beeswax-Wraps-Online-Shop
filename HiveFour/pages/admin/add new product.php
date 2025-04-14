<?php 
	include '../../config/dbconn.php';
	session_start();
	## verify if the session user is admin
	if(isset($_SESSION['username']) && $_SESSION['username'] == "Administrator"){
?>

<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
	<title>Add New Product</title>
	<head>
		<style>
			body{
				background-color:#E6DAD1;
				margin: 0;
				padding: 0;
			}
            table{
                font-family:calibri, sans-serif;
                color: #E6DAD1;
            }
			#acc{
                width: 792px;
				margin-left: auto;
				margin-right: auto;
				background-color:#8AB49C;
				border-radius:10px;	
				padding:20px;
				font-size:24px;
                border-spacing: 5px;
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
            #button{
                margin-left: auto;
                margin-right: auto;
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
	</table>
	<br><br>
    <form action="add new product process.php" method="POST" enctype="multipart/form-data">
        <table id=acc border="0">
            <tr>
                <th colspan=3 style="font-size:40px">ADD NEW PRODUCT</th>
            </tr>
            <tr>
                <td>Product Name</td>
                <td colspan=2>
                    <input type="text" name="pName" placeholder="Insert Product Name">
                </td>
            </tr>
            <tr>
                <td>Image</td>
                <td colspan="2">
                    <input type="file" name="image" accept="image/*">
                    <span style="font-size: 13px; font-style: italic;"> File type: .jpg, .jpeg, & .png only & max 10MB </span>
                </td>
            </tr>
			<td>Status</td>
                <td colspan="5">
                    <input type="hidden" name="productId" value="<?php echo $productId; ?>">
                    <select name="newStatus" class="mySelect">
                        <option value="PDS1">Available</option>
                        <option value="PDS2">Unavailable</option>
                    </select>
                </td>
            <tr>
                <td colspan=3 style="padding-top:10px; text-align: center;">
                    <button type="submit" name="update" style="background: none; border: none; padding: 0; cursor: pointer;">
                        <img src="publish.png" alt="Submit" value="update" style="display: inline-block;">
                    </button>
                </td>
            </tr>
        </table>
</form>
</html>

<?php
}else
{	## if the session username is no admin, redirect the page to the login page 
header("Location: ../../pages/customer/login.php");
}
?>