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
          $result = showStudentJustificants($conn, $_SESSION["controlNumber"]);

          while ($row = mysqli_fetch_assoc($result)) {
            echo ("
                <tr>
                  <th scope='row' name='idJustificante'>" . $row["idJustificante"] . "</th>
                  <td >" . $row["reason"] . "</td>
                  <td class='overflow'>" . $row["detailedInfo"] . "</td>
                  <td>" . $row["JustiDay"] . "-" . $row["JustiMonth"] . "</td>
                  <td>" . $row["fechaCreacion"] . "</td>
                  <td class='" . $row["estado"] . "'>" . $row["estado"] . "</td>
                  <td>
                    <form action='includes/justificationFunc.php' method='POST'>
                      <div class='btn-group' role='group' aria-label='Basic example'>
                      " . (($row['estado'] == 'Aprobado') ? '<a class="btn btn-primary" download="hola.docx" href="documents/hola.docx" >Descargar</a>' : '') . "
                      " . (($row['estado'] == 'Aprobado' || $row['estado'] == 'En espera') ? '<a href="includes/justificationFunc.php?justId=' . $row["idJustificante"] . '" class="btn btn-danger">Cancelar</a>' : '') . "
                      " . (($row['estado'] == 'Rechazado') ? '<a href="includes/justificationFunc.php?justId=' . $row["idJustificante"] . '" class="btn btn-danger">Eliminar</a>' : '') . "
                      </div>
                    </form>
                  </td>
                </tr>
                ");
          }
          ?>

        </tbody>
      </table>
    </div>
  </div>
  <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
    Solicitar justificantes
  </button>
</div>

<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Solicitud para justificante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="container-fluid">
          <div class="col-lg-12">
            <form action="includes/askJustification.php" method="POST">
              <h1>Solicitar Justificantes</h1>
              <div class="form-row">
                <div class="col">
                  <div class="form-group">
                    <label for="reason">Razón del jusitificante:</label>
                    <input type="text" class="form-control" name="reason" id="reason" aria-describedby="emailHelp"
                      placeholder="Ingrese la razón de su justificante">
                    <small id="reasonHelp" class="form-text text-muted">Esta información se mantendrá
                      confidencial.</small>
                  </div>
                </div>
                <div class="col">
                  <label for="ocurrenceDate">Fecha de la ocurrencia:</label>
                  <div class="form-group form-inline">
                    <div class="form-group">
                      <label for="month">Dia:</label>
                      <select id="day" name="day" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="month">Mes:</label>
                      <select id="month" name="month" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col">
                  <div class="form-group">
                    <label for="descripcionDetallada">Describa detalladamente la situación:</label>
                    <textarea class="form-control" id="descripcionDetallada" name="descripcionDetallada"
                      rows="3"></textarea>
                  </div>
                </div>
              </div>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="submit" name="submit" class="btn btn-primary">Enviar solicitud</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
let daySelect = document.getElementById("day");

for (let i = 1; i < 32; i++) {
  let dayOption = document.createElement("option");
  dayOption.text = i;
  dayOption.value = i;
  daySelect.append(dayOption);
}

let monthSelect = document.getElementById("month");

for (let i = 1; i < 13; i++) {
  let monthOption = document.createElement("option");
  monthOption.text = i;
  monthOption.value = i;

  monthSelect.append(monthOption);
}
</script>

<?php

include_once "./footer.php"

?>