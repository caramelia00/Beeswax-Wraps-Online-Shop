<?php

include '../../config/dbconn.php';
session_start ();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// verity for customer (user) 
if (isset ($_SESSION['username']) && $_SESSION ['username'] == "Customer")
{

//connection parameter 
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "hivefour";

// Create connection
$dbconn = mysqli_connect($host, $user, $pass, $dbname);

// Check connection
if (!$dbconn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET ['query']))
{
    $query = mysqli_query($dbconn, $sql) or die ("Error ".mysqli_error ($dbconn));
}

//prepare sql to prevent sql injection 

$stmt = $dbconn ->prepare ("SELECT Product_Name FROM product WHERE Product_Name LIKE Product_ID ");
$searchTerm = '%' . $query . "%";
$stmt ->bind_param( "Red Rose", $searchTerm);
$stmt ->execute ();
$stmt ->bind_result($Product_Name);


$result = [];

while ($stmt -> fetch())
{
    $result [] = $Product_Name;

}

$stmt ->close();
$dbconn->close ();

if (!empty ($result))
{
    echo 'Search results for "' . $query . '":<br>';
    foreach ($results as $result) {
        echo $result . '<br>';
    }
} else {
    echo 'No product found for "' . $query . '".';
}
} else {
echo 'No product query provided.';
}

?>


