<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "info";

$conn = new mysqli($host, $user, $pass, $db);

if(!$conn){
    echo "Connetion field!!";
    die();
}
?>