<?php

if (isset($_POST["submit"])) {
  session_start();
  $controlNumber = $_SESSION["controlNumber"];

  $file = $_FILES["studentAnteproyectoUpload"]["name"];

  $fileName = $_FILES["studentAnteproyectoUpload"]["name"];
  $fileTmpName = $_FILES["studentAnteproyectoUpload"]["tmp_name"];
  $fileSize = $_FILES["studentAnteproyectoUpload"]["size"];
  $fileError = $_FILES["studentAnteproyectoUpload"]["error"];
  $fileType = $_FILES["studentAnteproyectoUpload"]["type"];

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

        header("location: ../uploadAnteproyectoStudent.php?Success=" . $fileDestination);
      } else {
        header("location: ../uploadAnteproyectoStudent.php?error=ArchivoMuyGrande");
      }
    } else {
      header("location: ../uploadAnteproyectoStudent.php?error=ErrorAlSubirArchivo");
    }
  } else {
    header("location: ../uploadAnteproyectoStudent.php?error=ArchivoNoPermitido");
  }
} else {
  header("location: ../uploadAnteproyectoStudent.php?error=Nojalo");
}