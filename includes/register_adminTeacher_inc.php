<?php

if (isset($_POST["submit"])) {

  $controlNumber = $_POST["controlNumber"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $passwordRepeat = $_POST["passwordRepeat"];
  $nameInput = $_POST["nameInput"];
  $lastnameInput = $_POST["lastnameInput"];
  $userType = $_POST["userType"];

  require_once("dbh_inc.php");
  require_once("functions_inc.php");

  if (emptyInputAdminTeacherRegister(
    $controlNumber,
    $email,
    $password,
    $passwordRepeat,
    $nameInput,
    $lastnameInput,
    $userType
  )) {
    header("location: ../register_adminTeacher.php?error=emptyInput");
    exit();
  }
  if (invalidUID($controlNumber)) {
    header("location: ../register_adminTeacher.php?error=invalidControlNumber");
    exit();
  }
  if (!pwdMatch($password, $passwordRepeat)) {
    header("location: ../register_adminTeacher.php?error=noMatchingPwds");
    exit();
  }
  if (adminTeacherControlNumberExists($conn, $controlNumber)) {
    header("location: ../register_adminTeacher.php?error=controlNumberExists");
    exit();
  }
  if (adminTeacherEmailExists($conn, $email)) {
    header("location: ../register_adminTeacher.php?error=emailExists");
    exit();
  }

  createAdminTeacher(
    $conn,
    $controlNumber,
    $password,
    $email,
    $nameInput,
    $lastnameInput,
    $userType
  );
} else {
  header("location: ../register_adminTeacher.php");
}