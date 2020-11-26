<?php

function emptyInputRegister(
  $controlNumber,
  $email,
  $password,
  $passwordRepeat,
  $careerSelect,
  $semestreInput,
  $groupInput,
  $nameInput,
  $lastnameInput
) {
  if (
    empty($controlNumber) ||
    empty($email) ||
    empty($password) ||
    empty($passwordRepeat) ||
    empty($careerSelect) ||
    empty($semestreInput) ||
    empty($groupInput) ||
    empty($nameInput) ||
    empty($lastnameInput)
  ) {
    return true;
  }
  return false;
}

function emptyInputAdminTeacherRegister(
  $controlNumber,
  $email,
  $password,
  $passwordRepeat,
  $nameInput,
  $lastnameInput,
  $userType
) {
  if (
    empty($controlNumber) ||
    empty($email) ||
    empty($password) ||
    empty($passwordRepeat) ||
    empty($nameInput) ||
    empty($lastnameInput) ||
    empty($userType)
  ) {
    return true;
  }
  return false;
}

function emptyInputLogin($controlNumber, $password)
{
  if (empty($controlNumber || $password)) {
    return true;
  }
  return false;
}

function invalidUID($controlNumber)
{
  if (!preg_match("/\d*[a-zA-Z]\d*/", $controlNumber)) {
    return true;
  }
  return false;
}

function pwdMatch($password, $passwordRepeat)
{
  if ($password !== $passwordRepeat) {
    return false;
  }
  return true;
}

function studentControlNumberExists($conn, $controlNumber)
{
  $sql = "SELECT * from alumnos where controlNumber = ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../index.php?error=wrongSTMT");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $controlNumber);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  } else {
    return false;
  }

  mysqli_stmt_close($stmt);
}

function studentEmailExists($conn, $email)
{
  $sql = "SELECT * from alumnos where email = ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../index.php?error=wrongSTMT");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  } else {
    return false;
  }

  mysqli_stmt_close($stmt);
}

function adminTeacherEmailExists($conn, $email)
{
  $sql = "SELECT * from maestros where email = ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../index.php?error=wrongSTMT");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  } else {
    return false;
  }

  mysqli_stmt_close($stmt);
}

function adminTeacherControlNumberExists($conn, $controlNumber)
{
  $sql = "SELECT * from maestros where controlNumber = ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../index.php?error=wrongSTMT");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $controlNumber);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  } else {
    return false;
  }

  mysqli_stmt_close($stmt);
}

function createStudent(
  $conn,
  $controlNumber,
  $password,
  $email,
  $careerSelect,
  $semestreInput,
  $groupInput,
  $nameInput,
  $lastnameInput
) {
  $sql = "INSERT INTO alumnos (controlNumber, userPassword, email, career, semestre, grupo, userFirstName, lastname) VALUES (?,?,?,?,?,?,?,?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../index.php");
    exit();
  }

  $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param(
    $stmt,
    "ssssssss",
    strtoupper($controlNumber),
    $hashedPwd,
    $email,
    $careerSelect,
    $semestreInput,
    $groupInput,
    $nameInput,
    $lastnameInput
  );
  mysqli_stmt_execute($stmt);

  mysqli_stmt_close($stmt);

  header("location: ../login_student.php");
  exit();
}

function createAdminTeacher(
  $conn,
  $controlNumber,
  $password,
  $email,
  $nameInput,
  $lastnameInput,
  $userType
) {
  $sql = "INSERT INTO maestros (controlNumber, nameMaestro, lastNameMaestro, email, adminTeacherPwd, tipo_usuario) VALUES (?,?,?,?,?,?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../index.php");
    exit();
  }

  $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param(
    $stmt,
    "ssssss",
    strtoupper($controlNumber),
    $nameInput,
    $lastnameInput,
    $email,
    $hashedPwd,
    $userType
  );
  mysqli_stmt_execute($stmt);

  mysqli_stmt_close($stmt);

  header("location: ../index.php");
  exit();
}


function loginStudent($conn, $controlNumber, $password)
{
  $uidExists = studentControlNumberExists($conn, $controlNumber);

  if (!$uidExists) {
    header("location: ../login_student.php?error=noExistingUser");
    exit();
  }

  if (!password_verify($password, $uidExists["userPassword"])) {
    header("location: ../login_student.php?error=noMatchingPwd");
    exit();
  } else {
    session_start();
    $_SESSION["controlNumber"] = $uidExists["controlNumber"];
    $_SESSION["tipo_usuario"] = $uidExists["tipo_usuario"];
    header("location: ../index.php?=Success");
    exit();
  }
}

function loginAdminTeacher($conn, $controlNumber, $password)
{
  $uidExists = adminTeacherControlNumberExists($conn, $controlNumber);

  if (!$uidExists) {
    header("location: ../login_adminTeacher.php?error=noExistingUser");
    exit();
  }

  if (!password_verify($password, $uidExists["adminTeacherPwd"])) {
    header("location: ../login_adminTeacher.php?error=noMatchingPwd");
    exit();
  } else {
    session_start();
    $_SESSION["controlNumber"] = $uidExists["controlNumber"];
    $_SESSION["tipo_usuario"] = $uidExists["tipo_usuario"];
    header("location: ../index.php?=Success");
    exit();
  }
}

function saveFilepathToDB($conn, $controlNumber, $filepath)
{
  $uidExists = studentControlNumberExists($conn, $controlNumber);

  if (!$uidExists) {
    header("location: ../uploadAnteproyectoStudent.php?error=noExistingUser");
    exit();
  }

  $sql = "UPDATE alumnos SET anteproyectoDoc = ? WHERE controlNumber = ? ;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../uploadAnteproyectoStudent.php?error=noSePudoGuardarenDB");
    exit();
  }

  mysqli_stmt_bind_param(
    $stmt,
    "ss",
    $filepath,
    $controlNumber
  );

  mysqli_stmt_execute($stmt);

  mysqli_stmt_close($stmt);

  header("location: ../uploadAnteproyectoStudent.php?Success");

  exit();
}

//FUNCIONES DE TABLA

function getAllStudentFromDB($conn)
{
  $sql = "SELECT controlNumber, userFirstName, lastName, anteproyectoDoc from alumnos";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../anteproyecto_list.php?error=wrongSTMT");
    exit();
  }

  mysqli_stmt_execute($stmt);

  if ($resultData = mysqli_stmt_get_result($stmt)) {
    return $resultData;
  } else {
    return false;
  }

  mysqli_stmt_close($stmt);
}

//Funciones de justificantes

function createJustificant($controlNumber, $conn, $reason, $day, $month, $detailedInfo)
{
  $sql = "INSERT INTO justificantes (controlNumber, reason, JustiDay, JustiMonth, detailedInfo) VALUES (?,?,?,?,?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../index.php?errorSTMT");
    exit();
  }

  mysqli_stmt_bind_param(
    $stmt,
    "sssss",
    strtoupper($controlNumber),
    $reason,
    $day,
    $month,
    $detailedInfo
  );

  mysqli_stmt_execute($stmt);

  mysqli_stmt_close($stmt);

  header("location: ../index.php?Success");
  exit();
}

function showStudentJustificants($conn, $controlNumber)
{
  $sql = "SELECT idJustificante, controlNumber, reason, JustiDay, JustiMonth, detailedInfo, fechaCreacion, estado from justificantes WHERE controlNumber = ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../anteproyecto_list.php?error=wrongSTMT");
    exit();
  }

  mysqli_stmt_bind_param(
    $stmt,
    "s",
    $controlNumber
  );

  mysqli_stmt_execute($stmt);

  if ($resultData = mysqli_stmt_get_result($stmt)) {
    return $resultData;
  } else {
    return false;
  }

  mysqli_stmt_close($stmt);
}