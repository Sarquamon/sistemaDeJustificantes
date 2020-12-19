<?php

session_start();
$controlNumber = $_SESSION["controlNumber"];

if ($controlNumber) {
  $URL = basename($_SERVER["REQUEST_URI"]);
  $url_components = parse_url($URL);
  parse_str($url_components['query'], $params);

  require_once("dbh_inc.php");
  require_once("functions_inc.php");


  if (isAdmin($conn, $controlNumber)) {
    if ($params["action"] == "aprove") {
      if (changeJustificationState($conn, $params["justId"], "Aprobado")) {
        header("location: ../justificantesAdmin.php?errorAlCambiar1");
      } else {
        header("location: ../justificantesAdmin.php?Success");
      }
    } else if ($params["action"] == "reject") {
      if (changeJustificationState($conn, $params["justId"], "Rechazado")) {
        header("location: ../justificantesAdmin.php?errorAlCambiar3");
      } else {
        header("location: ../justificantesAdmin.php?Success");
      }
    } else {
      header("location: ../justificantesAdmin.php?error");
    }
  } else {
    header("location: ../justificantesAdmin.php?forbidden");
  }
} else {
  header("location: ../justificantesAdmin.php?error1");
}