<?php

include_once "./header.php"

?>

<div class="container">
  <div class="row">
    <div class="col">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Empresa</th>
            <th scope="col">Nombre Asesor</th>
            <th scope="col">Apellido Asesor</th>
            <th scope="col">Contacto</th>
            <th scope="col">Horas de contacto</th>
            <th scope="col">Alumno Asignado</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require_once("./includes/dbh_inc.php");
          require_once("./includes/functions_inc.php");
          $result = showAllAsesores($conn);

          while ($row = mysqli_fetch_assoc($result)) {
            $temp;
            if ($row["email"] == "") {
              $temp = $row["contactNumber"];
            } else if ($row["contactNumber"] == "") {
              $temp = $row["email"];
            } else {
              $temp = $row["email"];
            }
            echo ("
                <tr>
                  <th scope='row'>" . $row["companyName"] . "</th>
                  <td >" . $row["nombreAsesor"] . "</td>
                  <td >" . $row["nameAsesorInt"] . "</td>
                  <td >" . $temp . "</td>
                  <td >" . $row["horasContacto"] . "</td>
                  <td>" . $row["controlNumber"] . "</td>
                </tr>
                ");
          }
          ?>

        </tbody>
      </table>
    </div>
  </div>
</div>

<?php

include_once "./footer.php"

?>