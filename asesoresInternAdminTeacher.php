<?php

include_once "./header.php"

?>

<div class="container">
  <div class="row">
    <div class="col">
      <div class="centerText">
        <h2>Asesores Internos</h2>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">N° Control</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Numero alumnos asignados</th>
            <th scope="col">Opciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require_once("./includes/dbh_inc.php");
          require_once("./includes/functions_inc.php");
          $result = showAllTeachers($conn);

          while ($row = mysqli_fetch_assoc($result)) {
            $data = countAllAsignedStudent($conn, $row["controlNumber"]);
            $students = showAllAsignedStudents($conn, $row["controlNumber"]);
            echo ("
                <tr>
                  <td scope='row'>" . $row["controlNumber"] . "</td>
                  <td >" . $row["nameMaestro"] . "</td>
                  <td >" . $row["lastNameMaestro"] . "</td>
                  <td>" . $data["totalStudents"] . "</td>
                  <td class='different'>
                    <div class='btn-group' role='group' aria-label='Basic example'>
                    ");

            echo ("
                      <button type='button' class='btn btn-outline-primary' data-toggle='collapse' data-target='#studentData" . $row["controlNumber"] . "'>Mostrar Alumnos</button>
                    </div>
                  </td>
                </tr>
                ");

            while ($student = mysqli_fetch_assoc($students)) {
              echo ("
                    <tr class='collapse' id='studentData" . $row["controlNumber"] . "'>
                      <td scope='row' class='negritas'>" . $student["controlNumber"] . "</td>
                      <td >" . $student["userFirstName"] . "</td>
                      <td>" . $student["lastName"] . "</td>
                      <td>
                      
                      <form action='includes/deleteAsignedStudent.php' method='POST'>
                      <div class='btn-group' role='group' aria-label='Basic example'>
                      <a class='btn btn-outline-danger' href='includes/deleteAsignedStudent.php?studentControlNumber=" . $student['controlNumber'] . "'>Eliminar</a>
                      </div>
                    </form>
                    
                    </td>

                    </tr>
                ");
            }
          } ?>

        </tbody>
      </table>
    </div>
  </div>
  <?php
  if ($_SESSION["tipo_usuario"] == "Administrador") {
    echo ("<button type='button' class='btn btn-outline-primary float-right' data-toggle='modal' data-target='#exampleModal'>Asignar maestro a alumno</button>");
  }
  ?>
</div>

<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asignaci&oacute;n de alumnos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="container-fluid">
          <div class="col-lg-12">
            <form action="includes/asignStudent.php" method="POST">
              <h1>Asignar Maestro</h1>

              <div class="form-row">
                <div class="col">
                  <div class="form-group">
                    <label for="reason">Numero de control del maestro:</label>
                    <input type="text" class="form-control" name="controlNumberTeacher" id="controlNumberTeacher"
                      aria-describedby="emailHelp" placeholder="Ingrese el numero de control del maestro">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="reason">Numero de control del alumno:</label>
                    <input type="text" class="form-control" name="controlNumber" id="controlNumber"
                      aria-describedby="emailHelp" placeholder="Ingrese el numero de control del alumno">
                  </div>
                </div>
              </div>
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
              <button type="submit" name="submit" class="btn btn-outline-primary">Enviar solicitud</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php

include_once "./footer.php"

?>