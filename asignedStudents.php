<?php
require_once("./header.php");

?>

<div class="container">
  <br>
  <div class="row">
    <div class="col">
      <?php

      include_once("./includes/userHasStudents.php");
      include_once("./includes/userHasAsesorExt.php");

      if ($data = userHasStudents($controlNumber)) {
      ?>
      <form action='./includes/uploadAnteproyectoStudent_inc.php' method='POST' enctype='multipart/form-data'>

        <h1>Alumno asignado</h1>
        <div class='container-fluid studentInfo'>
          <div class='form-group'>
            <div class='form-row'>
              <div class='col'>
                <label for='externalAsesor'>Nombre(s)</label>
                <span class='form-control-plaintext'><span
                    class='custom-border'><?php echo ($data["studentFirstName"]) ?></span></span>
              </div>
              <div class='col'>
                <label for='nameInput'>Apellido Paterno</label>
                <span class='form-control-plaintext'><span
                    class='custom-border'><?php echo ($data["studentLastname"]) ?></span></span>
              </div>
              <!-- <div class='col'>
                <label for='lastnameInput'>Apellido Materno</label>
                <span class='form-control-plaintext'><span
                    class='custom-border'><?php //echo ($data["lastNameMaestro"]) 
                                          ?></span></span>
              </div> -->
            </div>
          </div>
          <div class='form-group'>
            <div class='form-row'>
              <div class='col'>
                <label for='email'>Carrera</label>
                <span class='form-control-plaintext'><span
                    class='custom-border'><?php echo ($data["studentCareer"]) ?></span></span>
              </div>
              <div class='col'>
                <label for='phone'>Correo</label>
                <span class='form-control-plaintext'><span
                    class='custom-border'><?php echo ($data["studentEmail"]) ?></span></span>
              </div>
            </div>
          </div>
          <div class='form-group'>
            <div class='form-row'>
              <div class='col'>
                <label for='openTime'>Semestre</label>
                <span class='form-control-plaintext'><span
                    class='custom-border'><?php echo ($data["studentSem"]) ?></span></span>
              </div>
              <div class='col'>
                <label for='companyName'>Grupo</label>
                <span class='form-control-plaintext'><span
                    class='custom-border'><?php echo ($data["studentGroup"]) ?></span></span>
              </div>
              <div class='col'>
                <label for='studentAnteproyectoUpload'>Archivo Subido</label>
                <div class='input-group'>
                  <div class='input-group-prepend'>
                    <span class='input-group-text' id='studentAnteproyectoUpload'>Archivo</span>
                  </div>
                  <div class='custom-file'>
                    <span class='form-control-plaintext'><span
                        class='custom-border'><?php echo ($data["anteproyectoDoc"]) ?></span></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <h1>Asesor Externo</h1>
        <?php
          if ($info = userHasAsesorExt($data["studentControlNumber"])) {
            if ($info["contactNumber"] == "") {
              $info["contactNumber"] = "N/A";
            } else if ($info["email"] == "") {
              $info["email"] = "N/A";
            };
          ?>

        <div class='container-fluid studentInfo'>
          <div class='form-group'>
            <div class='form-row'>
              <div class='col'>
                <label for='companyName'>Nombre asesor</label>
                <span class='form-control-plaintext'><span
                    class='custom-border'><?php echo ($info["nombreAsesor"] . " " . $info["nameAsesorInt"]) ?></span></span>
              </div>
              <div class='col'>
                <label for='cargo'>Contacto</label>
                <span class='form-control-plaintext'><span class='custom-border'>
                    <?php
                        if ($info["contactNumber"] == "N/A") {
                          echo ($info["email"]);
                        } else if ($info["email"] == "N/A") {
                          echo ($info["contactNumber"]);
                        } else if ($info["email"]) {
                          echo ($info["email"]);
                        } else {
                          echo ("El asesor solicitó no ser contactado.");
                        };
                        ?>

                  </span></span>
              </div>
            </div>
            <div class='form-row'>
              <div class='col'>
                <label for='companyName'>Empresa</label>
                <span class='form-control-plaintext'><span
                    class='custom-border'><?php echo ($info["companyName"]) ?></span></span>
              </div>
              <div class='col'>
                <label for='cargo'>Cargo</label>
                <span class='form-control-plaintext'><span
                    class='custom-border'><?php echo ($info["cargo"]) ?></span></span>
              </div>
              <div class='col'>
                <label for='cargo'>Horas de contacto</label>
                <span class='form-control-plaintext'><span
                    class='custom-border'><?php echo ($info["horasContacto"]) ?></span></span>
              </div>
            </div>
          </div>
        </div>
        <br>

      </form>


      <?php
          } else {
      ?>

      <div class='container-fluid studentInfo'>
        <div class='form-group'>
          <div class='form-row'>
            <div class='col'>
              <h2>Alumno no tiene asesor externo</h2>
            </div>
          </div>
        </div>
      </div>
      <br>

      </form>

      <?php
          }
      ?>
      <?php
      } else {
    ?>

      <div class='container-fluid studentInfo'>
        <div class='form-group'>
          <div class='form-row'>
            <div class='col'>
              <h2>No se te ha asignado un alumno</h2>
            </div>
          </div>
        </div>
      </div>
      <br>

      </form>

      <?php

      }

    ?>
    </div>
  </div>
</div>

<?php
require_once("./footer.php");

?>