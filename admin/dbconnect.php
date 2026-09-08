<?php 

try {

$host="localhost";
$dbname = "myblogb5";
$dbuser = "root";
$dbpassword = "";

$dsn = "mysql:host=$host;dbname=$dbname";
$conn = new PDO($dsn,$dbuser,$dbpassword);

$conn->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

echo "Connect sucess";
}
catch (PDOException $e){
    die ("Connection fail".$e->getMessage);

};