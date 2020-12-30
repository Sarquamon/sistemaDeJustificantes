<?php

session_start();

global $tipo_usuario;
global $controlNumber;

if (isset($_SESSION['tipo_usuario'])) {
  $tipo_usuario = $_SESSION['tipo_usuario'];
  $controlNumber = $_SESSION['controlNumber'];
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="css/styles.css">
</head>

<?php
if ($tipo_usuario == "Administrador") {
  require("./components/Navbars/adminNavbar.html");
} else if ($tipo_usuario == "Maestro") {
  require("./components/Navbars/teacherNavbar.html");
} else if ($tipo_usuario == "User") {
  require("./components/Navbars/userNavbar.html");
} else {
  require("./components/Navbars/loggedOutNavbar.html");
}
?>

<body>
  <div class="custom-body">