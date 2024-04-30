<?php
$host = 'localhost'; 
$user = 'root'; 
$password = ''; 
$database = 'bnu-php-CW2'; 

$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>