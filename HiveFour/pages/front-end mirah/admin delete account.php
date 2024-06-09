<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Hive4</title>
    <style>			
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
    body{
        background-color:#E6DAD1;
        font-family: Calibri, sans-serif;
        font-size: 20px;
    }
    #del{
        padding-top: 20px; ;
        margin-left: auto;
        margin-right: auto;
        background-color: #8AB49C;
        border-radius:10px;	
		padding:50px;
        text-align: center;
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
    .user:hover {
        opacity: 0.8;
    }

    .user:hover + p {
        display: block;
    }
    input[type="image"] {
        border: none;
        cursor: pointer;
    }
    input[type="image"]:focus {
        outline: none;
    }
</style>
</head>
<table id=header  border="0">
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
<br><br>
<table id=del border="0">
    <tr colspan=2>
        <th colspan="2" style="font-size: 40px; font-family: 'Times New Roman', serif;">ACCOUNT DELETION</th>
    </tr>
    <tr>
        <td colspan=2>
            <p>
                If you delete your account, you will lose access to all your data in HIVEFOUR website.
                <br>
                *Removing the administration connection from the HIVEFOUR website may take some time.
            </p>
        </td>
    </tr>
    <tr>
        <td id="btn">
            <form action="delete account process.php" method="POST">
                <button type="delete" name="delete" style="background: none; border: none; padding: 0; cursor: pointer;">
						<img src="delete account.png" alt="Delete Account" value="update" style="display: inline-block;">
				</button>

            </form>
        </td>
        <td>
            <a href="admin view account.php">
                <img src="cancel.png">
            </a>
        </td>
</table>
</html>