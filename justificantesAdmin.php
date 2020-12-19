<?php

include_once "./header.php"

?>

<div class="container">
  <div class="row">
    <div class="col">
      <table class="table">
        <thead>
          <tr>
            <th scope="col"># Just.</th>
            <th scope="col"># Control</th>
            <th scope="col">Nombre-Apellido</th>
            <th scope="col">Razón</th>
            <th scope="col">Detalles</th>
            <th scope="col">Fecha falta</th>
            <th scope="col">Fecha Creacion</th>
            <th scope="col">Estado</th>
            <th scope="col">Opciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require_once("./includes/dbh_inc.php");
          require_once("./includes/functions_inc.php");
          $result = showAllStudentsJustificants($conn);

          while ($row = mysqli_fetch_assoc($result)) {
            echo ("
                <tr>
                  <th scope='row' name='idJustificante'>" . $row["idJustificante"] . "</th>
                  <td >" . $row["controlNumber"] . "</td>
                  <td >" . $row["userFirstName"] . "-" . $row["lastname"] . "</td>
                  <td >" . $row["reason"] . "</td>
                  <td class='overflow'>" . $row["detailedInfo"] . "</td>
                  <td>" . $row["JustiDay"] . "-" . $row["JustiMonth"] . "</td>
                  <td>" . $row["fechaCreacion"] . "</td>
                  <td class='" . $row["estado"] . "'>" . $row["estado"] . "</td>
                  <td>
                    <div class='btn-group' role='group' aria-label='Basic example'>
                      " . (($row['estado'] == 'Rechazado' || $row['estado'] == 'En espera') ? '<a href="includes/justificationAdminFunc.php?action=aprove&justId=' . $row["idJustificante"] . '" class="btn btn-success">Aprobar</a>' : '') . "
                      " . (($row['estado'] == 'Aprobado' || $row['estado'] == 'En espera') ? '<a href="includes/justificationAdminFunc.php?action=reject&justId=' . $row["idJustificante"] . '" class="btn btn-danger">Rechazar</a>' : '') . "
                    </div>
                  </td>
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