<?php

if (isset($_POST["submit"])) {

  $controlNumber = $_POST["controlNumber"];
  $password = $_POST["password"];

  require_once("dbh_inc.php");
  require_once("functions_inc.php");

  if (emptyInputLogin($controlNumber, $password)) {
    header("location: ../login._adminTeacherphp?error=emptyInput");
    exit();
  }

  loginAdminTeacher($conn, $controlNumber, $password);
} else {
  header("location: ../login_adminTeacher.php");
}