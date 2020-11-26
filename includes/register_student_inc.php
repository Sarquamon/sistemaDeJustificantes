<?php

if (isset($_POST["submit"])) {

  $controlNumber = $_POST["controlNumber"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $passwordRepeat = $_POST["passwordRepeat"];
  $careerSelect = $_POST["careerSelect"];
  $semestreInput = $_POST["semestreInput"];
  $groupInput = $_POST["groupInput"];
  $nameInput = $_POST["nameInput"];
  $lastnameInput = $_POST["lastnameInput"];

  require_once("dbh_inc.php");
  require_once("functions_inc.php");

  if (emptyInputRegister(
    $controlNumber,
    $email,
    $password,
    $passwordRepeat,
    $careerSelect,
    $semestreInput,
    $groupInput,
    $nameInput,
    $lastnameInput
  )) {
    header("location: ../register_student.php?error=emptyInput");
    exit();
  }
  if (invalidUID($controlNumber)) {
    header("location: ../register_student.php?error=invalidControlNumber");
    exit();
  }
  if (!pwdMatch($password, $passwordRepeat)) {
    header("location: ../register_student.php?error=noMatchingPwds");
    exit();
  }
  if (studentControlNumberExists($conn, $controlNumber)) {
    header("location: ../register_student.php?error=controlNumberExists");
    exit();
  }

  if (studentEmailExists($conn, $email)) {
    header("location: ../register_student.php?error=emailExists");
    exit();
  }

  createStudent(
    $conn,
    $controlNumber,
    $password,
    $email,
    $careerSelect,
    $semestreInput,
    $groupInput,
    $nameInput,
    $lastnameInput
  );
} else {
  header("location: ../register_student.php");
}