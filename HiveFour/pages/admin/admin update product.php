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

        $pId = $rProduct['Product_ID'];
        $pName = $rProduct['Product_Name'];
        $pImage = $rProduct['Product_Image'];
        $pStatus = $rProduct['Product_Status_ID'];
    }
}

## If the update button is clicked 
if(isset($_POST['update'])) {

    ## Capture values from HTML form 
    $pId = $_POST['pId']; 
    $pName = $_POST['pName']; 
    $pStatus = $_POST['newStatus'];

    ## Check if product name is empty
    if (empty($pName)) {
        echo "<script>
                alert('Product name cannot be empty!');
                window.location.href = 'admin update product.php?productId=$pId';
              </script>";
    }else{
        
    ## Image upload handling
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
        $file = $_FILES['image'];

        $fileName = $_FILES['image']['name'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];
        $fileError = $_FILES['image']['error'];
        $fileType = $_FILES['image']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg','jpeg','png');

        if(in_array($fileActualExt, $allowed)) {
            if($fileError === 0) {
                // File size must be < 10MB
                if($fileSize < 10485760) {
                    $fileNameNew = $pId.".".$fileActualExt;
                    $fileDestination = '../../assets/prodPic/'. $fileNameNew;

                    move_uploaded_file($fileTmpName, $fileDestination); // To upload file to a specific folder

                    $sqlUpdateImage = "UPDATE product SET Product_Image = '$fileDestination' WHERE Product_ID = '$pId'";
                    mysqli_query($dbconn, $sqlUpdateImage) or die ("Error: " . mysqli_error($dbconn));
                } else {
                    echo "<script>
                            alert('File is too big!');
                          </script>";   
                    exit();
                }
            } else {
                echo "<script>
                        alert('There is an error in this file!');
                      </script>";  
                exit();
            }
        } else {
            echo "<script>
                    alert('PNG, JPG, JPEG only!');
                  </script>";  
            exit();
        }
    } else

    $sqlUpdate = "UPDATE product SET Product_Name = '$pName',  Product_Status_ID = '$pStatus' WHERE Product_ID = '$pId'";
    mysqli_query($dbconn, $sqlUpdate) or die ("Error: " . mysqli_error($dbconn));

    /* Display a message */
    echo "<script>
            alert('Data has been updated');
            window.location.href = 'admin product list.php';
          </script>";   
}
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
    <title>Update Product Details</title>
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
<?php include 'admin header.php'; ?>
    <br><br>
    <form action="" method="POST" enctype="multipart/form-data">
        <table id="acc" border="0">
            <tr>
                <th colspan=5 style="font-size:40px">UPDATE PRODUCT DETAILS </th>
            </tr>
            <tr>
                <td>Product Name</td>
                <td colspan=4>
                    <input type="text" name="pName" value="<?php echo $pName; ?>">
                </td>
            </tr>
            <tr>
                <td>Image</td>
                <td colspan="4">
                    <input type="file" name="image" accept="image/*">
                    <span style="font-size: 13px; font-style: italic;"> File type: .jpg, .jpeg, & .png only & max 10MB </span>
                </td>
            </tr>
            <tr>
                <td>Status</td>
                <td colspan="5">
                    <input type="hidden" name="productId" value="<?php echo $productId; ?>">
                    <select name="newStatus" class="mySelect">
                        <option value="PDS1"<?php echo ($pStatus == 'PDS1' ? ' selected' : ''); ?>>Available</option>
                        <option value="PDS2"<?php echo ($pStatus == 'PDS2' ? ' selected' : ''); ?>>Unavailable</option>
                    </select>
                </td>
            </tr>
            <input type="hidden" name="pId" value="<?php echo $pId; ?>">
            <tr>
                <td colspan="6">
                    <table id="button" border="0">
                        <tr>
                            <td>
                                <button type="submit" name="update" style="background: none; border: none; padding: 0; cursor: pointer;">
                                    <img src="publish.png" alt="Submit" value="update" style="display: inline-block;">
                                </button>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
