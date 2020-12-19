<?php

if (isset($_POST["submit"])) {
  session_start();
  $controlNumber = $_SESSION["controlNumber"];

  $nombreAsesor = $_POST["externalAsesor"];
  $nameInput = $_POST["nameInput"];
  $lastnameInput = $_POST["lastnameInput"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $openTime = $_POST["openTime"];
  $closeTime = $_POST["closeTime"];
  $ampmOpenTime = $_POST["ampmOpenTime"];
  $ampmCloseTime = $_POST["ampmCloseTime"];
  $companyName = $_POST["companyName"];
  $cargo = $_POST["cargo"];

  $file = $_FILES["studentAnteproyectoUpload"]["name"];

  $fileName = $_FILES["studentAnteproyectoUpload"]["name"];
  $fileTmpName = $_FILES["studentAnteproyectoUpload"]["tmp_name"];
  $fileSize = $_FILES["studentAnteproyectoUpload"]["size"];
  $fileError = $_FILES["studentAnteproyectoUpload"]["error"];
  $fileType = $_FILES["studentAnteproyectoUpload"]["type"];

  require_once("functions_inc.php");

  if (emptyInputAsesor($controlNumber, $nombreAsesor, $nameInput, $lastnameInput, $email, $phone, $companyName, $cargo, $openTime, $closeTime, $ampmOpenTime, $ampmCloseTime, $file)) {
    header("location: ../uploadAnteproyectoStudent.php?error=emptyInput");
    exit();
  } else {
    $fileExt = explode(".", $fileName);

    $fileActualExt = strtolower(end($fileExt));

    $allowed = array("doc", "docx", "pdf");

    if (in_array($fileActualExt, $allowed)) {
      if ($fileError === 0) {
        if ($fileSize < 100000) {
          $fileNameNew = uniqid("", true) . "." . $fileActualExt;
          $fileDestination = "../uploads/" . $fileNameNew;
          move_uploaded_file($fileTmpName, $fileDestination);

          require_once("./dbh_inc.php");
          require_once("./functions_inc.php");

          saveFilepathToDB($conn, $controlNumber, $fileNameNew);
          createAsesor($conn, $nombreAsesor, $nameInput, $lastnameInput, $email, $phone, $companyName, $cargo, $openTime, $closeTime, $ampmOpenTime, $ampmCloseTime);
          $idAsesor = getAsesor($conn, $email, $phone);
          print_r($idAsesor);
          updateStudentWithAsesor($conn, $controlNumber, $idAsesor);

          header("location: ../uploadAnteproyectoStudent.php?Success");
        } else {
          header("location: ../uploadAnteproyectoStudent.php?error=ArchivoMuyGrande");
        }
      } else {
        header("location: ../uploadAnteproyectoStudent.php?error=ErrorAlSubirArchivo");
      }
    } else {
      header("location: ../uploadAnteproyectoStudent.php?error=ArchivoNoPermitido");
    }
  }
} else {
  header("location: ../uploadAnteproyectoStudent.php?error=Nojalo");
}