<?php

$servername = "localhost";
$username = "hynmhemy_NgeZY";
$password = "2.u&EPt@T2!2";
$dbname = "hynmhemy_utmadvance";


$con = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>
