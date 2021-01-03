<?php

if (isset($_POST["submit"])) {
  session_start();
  $controlNumber = $_POST["controlNumber"];
  $controlNumberTeacher = $_POST["controlNumberTeacher"];

  require_once("dbh_inc.php");
  require_once("functions_inc.php");

  if (emptyInput($controlNumber, $controlNumberTeacher)) {
    header("location: ../asesoresInternAdminTeacher.php?error=emptyInput");
    exit();
  }

  asignStudent($conn, $controlNumber, $controlNumberTeacher);
} else {
  header("location: ../asesoresInternAdminTeacher.php?error");
}