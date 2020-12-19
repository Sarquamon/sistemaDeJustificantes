<?php

session_start();
$controlNumber = $_SESSION["controlNumber"];

if ($controlNumber) {
  $URL = basename($_SERVER["REQUEST_URI"]);
  $url_components = parse_url($URL);
  parse_str($url_components['query'], $params);

  require_once("dbh_inc.php");
  require_once("functions_inc.php");

  if (isOwner($conn, $controlNumber, $params["justId"])) {
    if (deleteJustificante($conn, $controlNumber, $params["justId"])) {
      header("location: ../justificantes.php?errorAlborrar");
    } else {
      header("location: ../justificantes.php?Success");
    }
  } else {
    header("location: ../justificantes.php?forbidden");
  }
} else {
  header("location: ../justificantes.php?error1");
}