<?php
function userHasAsesorInt($controlNumber)
{
  require("./includes/dbh_inc.php");

  if ($data = getUserAsesorInt($conn, $controlNumber)) {
    return $data;
  } else {
    return false;
  }
}