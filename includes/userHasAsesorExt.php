<?php

function userHasAsesorExt($controlNumber)
{
  require_once("functions_inc.php");
  require_once("dbh_inc.php");

  if ($data = getUserAsesorExt($conn, $controlNumber)) {
    return $data;
  } else {
    return false;
  }
}