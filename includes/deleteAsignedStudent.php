<?php

session_start();
$controlNumber = $_SESSION["controlNumber"];

if ($controlNumber) {
  $URL = basename($_SERVER["REQUEST_URI"]);
  $url_components = parse_url($URL);
  parse_str($url_components['query'], $params);

  require_once("dbh_inc.php");
  require_once("functions_inc.php");

  if (deleteAsignedStudent($conn, $params["studentControlNumber"])) {
    header("location: ../asesoresInternAdminTeacher.php?Success");
  } else {
    header("location: ../asesoresInternAdminTeacher.php?errorAlborrar");
  }
} else {
  header("location: ../asesoresInternAdminTeacher.php?error1");
}