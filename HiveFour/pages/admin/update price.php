<?php
include '../../config/dbconn.php';

if (isset($_POST['update'])) {
    $sizeS = getSize('S');
    $rowS = mysqli_fetch_assoc($sizeS);
    $priceS = $rowS['Size_Price'];

    $sizeM = getSize('M');
    $rowM = mysqli_fetch_assoc($sizeM);
    $priceM = $rowM['Size_Price'];

    $sizeL = getSize('L');
    $rowL = mysqli_fetch_assoc($sizeL);
    $priceL = $rowL['Size_Price'];
}

##If the update button is clicked 
if(isset($_POST['updatePrice'])){

    ##	capture values from HTML form  
    $priceS= $_POST['priceS']; 
    $priceM= $_POST['priceM']; 
    $priceL= $_POST['priceL'];

    if($priceS == "" || $priceM == "" || $priceL == "") {
        // Display the alert
        echo "<script>alert('One or more prices are empty!'); 
        </script>";
    }else{ 

    ## execute SQL UPDATE command 
    $sqlUpdateS = "UPDATE size SET Size_Price = '" . $priceS . "'
    WHERE Size_ID = 'S'";
    mysqli_query($dbconn, $sqlUpdateS) or die ("Error: " . mysqli_error($dbconn));

    $sqlUpdateS = "UPDATE size SET Size_Price = '" . $priceM . "'
    WHERE Size_ID = 'M'";
    mysqli_query($dbconn, $sqlUpdateS) or die ("Error: " . mysqli_error($dbconn));

    $sqlUpdateS = "UPDATE size SET Size_Price = '" . $priceL . "'
    WHERE Size_ID = 'L'";
    mysqli_query($dbconn, $sqlUpdateS) or die ("Error: " . mysqli_error($dbconn));


    /* display a message */
    echo "<script>
            alert('Data has been updated');
            window.location.href = 'admin product list.php';
        </script>";
    }
        
}

function getSize($sizeId)
{
    global $dbconn;
    $sql = "SELECT *
            FROM size
            WHERE Size_ID = '$sizeId'";
    $result = mysqli_query($dbconn, $sql);
    return $result;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Update Price</title>
    <style>
        body {
            background-color: #E6DAD1;
            margin: 0;
            padding: 0;
        }
        #acc {
            width: 790px;
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
<?php include 'admin header.php'; ?>
    <br><br>
    <form action="" method="POST">
        <table id="acc" border="0">
            <tr>
                <th colspan=5 style="font-size:40px">UPDATE PRODUCT PRICES </th>
            </tr>
            <br>
            <tr>
                <td>Small</td>
                <td> : </td>
                <td>RM</td>
                <td>
                    <input type="text" name="priceS" value="<?php echo $priceS; ?>">
                </td>
            </tr>
            <tr>
                <td>Medium</td>
                <td> : </td>
                <td>RM</td>
                <td>
                    <input type="text" name="priceM" value="<?php echo $priceM; ?>">
                </td>
            </tr>
            <tr>
                <td>Large</td>
                <td> : </td>
                <td>RM</td>
                <td>
                    <input type="text" name="priceL" value="<?php echo $priceL; ?>">
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <table id="button" border="0">
                        <tr>
                            <td style="width: 48px;">
                                <p style="text-align: center;">
                                    <button type="submit" name="updatePrice" style="display: inline-block; padding: 10px 20px; background-color: #ffffff; color: #a5695d; border-radius: 40px; font-size: 13px; border: none; cursor: pointer;">UPDATE PRICE</button>
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
