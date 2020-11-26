<?php

$serverName = "localhost";
$dbUser = "root";
$dbPwd = "";
$dbName = "academia";

$conn = mysqli_connect($serverName, $dbUser, $dbPwd, $dbName);

if (!$conn) {
  die("Conexión fallida: " . mysqli_connect_error());
}