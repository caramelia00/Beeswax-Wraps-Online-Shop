<?php
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
/*else{
    echo "<center>Database connected successfully.</center>";
}*/

/*function unique_id(){
    $chars = '0123456789abcdefghijklmnopqrxtuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLength = strLen($chars);
    $randomString = '';
    for ($i=0; $i<20; $i++){
        $randomString.=$chars[mt_rand(0, $charLength-1)];
    }
    return $randomString;
}*/
?>
