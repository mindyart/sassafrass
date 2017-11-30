<?php
function getdb(){
$servername = "us-cdbr-iron-east-05.cleardb.net";
$username = "bb0d2f98312b26";
$password = "5f223c55";
$db = "heroku_ea9976a5409603d";
 
try {
   
    $conn = mysqli_connect($servername, $username, $password, $db);
     //echo "Connected successfully"; 
    }
catch(exception $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}
?>  