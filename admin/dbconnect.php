<?php

try {

$host = "localhost";
$dbname = "myblog";
$dbuser = "root";
$dbpassword = "";

//Data Source name
$dsn = "mysql:host=$host;dbname=$dbname";
$conn = new PDO($dsn,$dbuser,$dbpassword);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// echo"connection success";


}catch(PDOException $e){
    die("Connection fail:".$e->getMessage());
};