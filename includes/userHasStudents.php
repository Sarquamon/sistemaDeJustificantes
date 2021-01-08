<?php
function userHasStudents($controlNumber)
{
  require_once("./includes/functions_inc.php");

  if ($data = getUserStudent($conn, $controlNumber)) {
    return $data;
  } else {
    return false;
  }
}