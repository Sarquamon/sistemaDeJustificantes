<?php
include_once("header.php");

if (isset($_SESSION['tipo_usuario']) && ($_SESSION['tipo_usuario'] === "Administrador" || $_SESSION['tipo_usuario'] === "Maestro")) {
?>

<div class="container">
  <div class="row">
    <div class="col">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">N° Control</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Opciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
            require_once("./includes/dbh_inc.php");
            require_once("./includes/functions_inc.php");
            $result = getAllStudentFromDB($conn);

            while ($row = mysqli_fetch_assoc($result)) {
              echo ("
                <tr>
                <th scope='row'>" . $row["controlNumber"] . "</th>
                <td>" . $row["userFirstName"] . "</td>
                <td>" . $row["lastName"] . "</td>
                <td> <a class='btn btn-primary' download='" . $row["anteproyectoDoc"] . "' href='uploads/" . $row["anteproyectoDoc"] . "' >Descargar</a></td>
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
} else {
  header("location: ./login_student.php?error=unauthorized");
}

include_once("footer.php")

?>