<?php
function getdb(){
$servername = "us-cdbr-iron-east-05.cleardb.net";
$username = "be47041b8f6eac";
$password = "d6cb8661";
$db = "heroku_17d28927bcb96ef";

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
