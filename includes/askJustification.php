<?php

if (isset($_POST["submit"])) {
  session_start();
  $reason = $_POST["reason"];
  $day = $_POST["day"];
  $month = $_POST["month"];
  $detailedInfo = $_POST["descripcionDetallada"];
  $controlNumber = $_SESSION["controlNumber"];

  require_once("dbh_inc.php");
  require_once("functions_inc.php");

  if (emptyInputLogin($reason, $day, $month, $detailedInfo)) {
    header("location: ../justificantes.php?error=emptyInput");
    exit();
  }

  createJustificant($controlNumber, $conn, $reason, $day, $month, $detailedInfo);
} else {
  header("location: ../justificantes.php?error");
}