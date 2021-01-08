<?php

$controlNumber = '';
$tipo_usuario = '';

$_SESSION['tipo_usuario'] = '';
$_SESSION['controlNumber'] = '';

session_start();
session_unset();
session_destroy();

header("location: ../index.php");
exit();