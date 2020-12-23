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

  header("location: ../justificantes.php?Success");
  exit();
}

function showStudentJustificants($conn, $controlNumber)
{
  $sql = "SELECT idJustificante, controlNumber, reason, JustiDay, JustiMonth, detailedInfo, fechaCreacion, estado from justificantes WHERE controlNumber = ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../justificantes.php?error=wrongSTMT");
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

function showAllStudentsJustificants($conn)
{
  $sql = "SELECT j.idJustificante, j.controlNumber, j.reason, j.JustiDay, j.JustiMonth, j.detailedInfo, j.fechaCreacion, j.estado, a.userFirstName, a.lastname from justificantes j INNER JOIN alumnos a ON a.controlNumber = j.controlNumber";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../justificantes.php?error=wrongSTMT");
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

function isOwner($conn, $controlNumber, $justId)
{
  $sql = "SELECT idJustificante, controlNumber from justificantes WHERE controlNumber = ? AND idJustificante = ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../justificantes.php?error=wrongSTMT");
    exit();
  }

  mysqli_stmt_bind_param(
    $stmt,
    "ss",
    $controlNumber,
    $justId
  );

  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  } else {
    return false;
  }

  mysqli_stmt_close($stmt);
}

function isAdmin($conn, $controlNumber)
{
  $sql = "SELECT tipo_usuario from maestros WHERE controlNumber = ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../justificantesAdmin.php?error=wrongSTMT");
    exit();
  }

  mysqli_stmt_bind_param(
    $stmt,
    "s",
    $controlNumber
  );

  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($resultData);

  if ($row["tipo_usuario"] == "Administrador") {
    return true;
  } else {
    return false;
  }

  mysqli_stmt_close($stmt);
}

function deleteJustificante($conn, $controlNumber, $justId)
{
  $sql = "DELETE FROM justificantes WHERE controlNumber = ? AND idJustificante = ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../justificantes.php?error=wrongSTMT");
    exit();
  }

  mysqli_stmt_bind_param(
    $stmt,
    "ss",
    $controlNumber,
    $justId
  );

  mysqli_stmt_execute($stmt);

  if (mysqli_stmt_get_result($stmt)) {
    return true;
  } else {
    return false;
  }

  mysqli_stmt_close($stmt);
}

function changeJustificationState($conn, $idJust, $state)
{
  $sql = "UPDATE justificantes SET estado = ? WHERE idJustificante = ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../justificantes.php?error=wrongSTMT");
    exit();
  }

  mysqli_stmt_bind_param(
    $stmt,
    "ss",
    $state,
    $idJust
  );

  mysqli_stmt_execute($stmt);

  if (mysqli_stmt_get_result($stmt)) {
    return true;
  } else {
    return false;
  }

  mysqli_stmt_close($stmt);
}

function emptyInputAsesor($controlNumber, $nombreAsesor, $nameInput, $lastnameInput, $email, $phone, $companyName, $cargo, $openTime, $closeTime, $ampmOpenTime, $ampmCloseTime, $file)
{
  if (
    empty($controlNumber) ||
    empty($nombreAsesor) ||
    empty($nameInput) ||
    empty($lastnameInput) ||
    (empty($email) && empty($phone)) ||
    empty($companyName) ||
    empty($cargo) ||
    empty($openTime) ||
    empty($closeTime) ||
    empty($ampmCloseTime) ||
    empty($ampmOpenTime) ||
    empty($file)
  ) {
    return true;
  }
  return false;
}

function createAsesor($conn, $nombreAsesor, $nameInput, $lastnameInput, $email, $phone, $companyName, $cargo, $openTime, $closeTime, $ampmOpenTime, $ampmCloseTime)
{
  $sql = "INSERT INTO asesoresinternos (nombreAsesor, nameAsesorInt, lastNameMaestro, email, contactNumber, companyName, cargo, horasContacto) VALUES (?,?,?,?,?,?,?,?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../index.php");
    exit();
  }

  $newHours = strval($openTime) . strval($ampmOpenTime) . "-" . strval($closeTime) . strval($ampmCloseTime);

  mysqli_stmt_bind_param(
    $stmt,
    "ssssssss",
    $nombreAsesor,
    $nameInput,
    $lastnameInput,
    $email,
    $phone,
    $companyName,
    $cargo,
    $newHours
  );
  mysqli_stmt_execute($stmt);

  mysqli_stmt_close($stmt);
}

function getAsesor($conn, $email, $phone)
{
  $sql = "SELECT idAsesorInt from asesoresinternos where email = ? OR contactNumber = ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../index.php?error=wrongSTMT");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $email, $phone);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($resultData);
  $id = $row["idAsesorInt"];

  if ($id) {
    return $id;
  } else {
    return false;
  }

  mysqli_stmt_close($stmt);
}

function updateStudentWithAsesor($conn, $controlNumber, $idAsesor)
{
  $sql = "UPDATE alumnos SET intAsesor = ? where controlNumber = ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../index.php?error=wrongSTMT");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $idAsesor, $controlNumber);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return true;
  } else {
    return false;
  }

  mysqli_stmt_close($stmt);
}

function getUserAsesor($conn, $controlNumber)
{
  $sql = "SELECT * from alumnos a INNER JOIN asesoresinternos i ON a.intAsesor = i.idAsesorInt where controlNumber = ?;";
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

function showAllAsesores($conn)
{
  $sql = "SELECT ase.nombreAsesor, ase.nameAsesorInt, ase.email, ase.contactNumber, ase.companyName, ase.horasContacto, a.controlNumber from asesoresinternos ase INNER JOIN alumnos a ON a.intAsesor = ase.idAsesorInt";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../asesoresAdminTeacher.php?error=wrongSTMT");
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