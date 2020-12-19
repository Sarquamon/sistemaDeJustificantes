<?php


function userHasAsesor($controlNumber)
{
  require_once("./includes/dbh_inc.php");
  require_once("./includes/functions_inc.php");

  if ($data = getUserAsesor($conn, $controlNumber)) {
    return $data;
  } else {
    return false;
  }
}