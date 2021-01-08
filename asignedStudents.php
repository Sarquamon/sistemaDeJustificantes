<?php
require_once("./header.php");

?>

<div class="container">
  <br>
  <div class="row">
    <div class="col">

      <?php
      include_once("./includes/check_students.php");
      if ($data = userHasStudents($controlNumber)) {

        if ($data["contactNumber"] == "") {
          $data["contactNumber"] = "N/A";
        } else if ($data["email"] == "") {
          $data["email"] = "N/A";
        };

        echo ("
        
        <form action='./includes/uploadAnteproyectoStudent_inc.php' method='POST' enctype='multipart/form-data'>

        <h1>Informaci&oacute;n del alumno</h1>
        <div class='container-fluid studentInfo'>
          <div class='form-group'>
            <div class='form-row'>
              <div class='col'>
                <label for='externalAsesor'>Nombre(s)</label>
                <span class='form-control-plaintext'><span class='custom-border'>" . $data["studentFirstName"] .
          "</span></span>
              </div>
              <div class='col'>
                <label for='nameInput'>Apellido Paterno</label>
                <span class='form-control-plaintext'><span class='custom-border'>" . $data["studentLastname"] .
          "</span></span>
              </div>
            </div>
          </div>

          <div class='form-group'>
            <div class='form-row'>
              <div class='col'>
                <label for='email'>Numero de control</label>
                <span class='form-control-plaintext'><span class='custom-border'>" . $data["studentControlNumber"] . "</span></span>
              </div>
              <div class='col'>
                <label for='openTime'>Semestre</label>
                <span class='form-control-plaintext'><span class='custom-border'>" . $data["studentSem"] .
          "</span></span>
              </div>
              <div class='col'>
                <label for='phone'>Grupo</label>
                <span class='form-control-plaintext'><span class='custom-border'>" . $data["studentGroup"] .
          "</span></span>
              </div>
            </div>
          </div>

          <div class='form-group'>
            <div class='form-row'>
              <div class='col'>
                <label for='openTime'>Carrera</label>
                <span class='form-control-plaintext'><span class='custom-border'>" . $data["studentCareer"] .
          "</span></span>
              </div>

              <div class='col'>
              <label for='email'>Email</label>
              <span class='form-control-plaintext'><span class='custom-border'>" . $data["studentEmail"] . "</span></span>
            </div>
              <div class='col'>

                <label for='studentAnteproyectoUpload'>Archivo Subido</label>
                <div class='input-group'>
                  <div class='input-group-prepend'>
                    <span class='input-group-text' id='studentAnteproyectoUpload'>Archivo</span>
                  </div>
                  <div class='custom-file'>
                    <span class='form-control-plaintext'><span class='custom-border'>\t" . $data["anteproyectoDoc"] .
          "</span></span>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

        <h1>Asesor Externo</h1>
        <div class='container-fluid studentInfo'>
          <div class='form-group'>
            <div class='form-row'>
              <div class='col'>
                <label for='externalAsesor'>Nombre(s)</label>
                <span class='form-control-plaintext'><span class='custom-border'>" . $data["nombreAsesor"] .
          "</span></span>
              </div>
              <div class='col'>
                <label for='nameInput'>Apellido Paterno</label>
                <span class='form-control-plaintext'><span class='custom-border'>" . $data["nameAsesorInt"] .
          "</span></span>
              </div>
              <div class='col'>
                <label for='lastnameInput'>Apellido Materno</label>
                <span class='form-control-plaintext'><span class='custom-border'>" . $data["lastNameMaestro"] .
          "</span></span>
              </div>
            </div>
          </div>

          <div class='form-group'>
            <div class='form-row'>
              <div class='col'>
                <label for='email'>Email</label>
                <span class='form-control-plaintext'><span class='custom-border'>" . $data["email"] . "</span></span>
              </div>
              <div class='col'>
                <label for='phone'>Teléfono</label>
                <span class='form-control-plaintext'><span class='custom-border'>" . $data["contactNumber"] .
          "</span></span>
              </div>
            </div>
          </div>

          <div class='form-group'>
            <div class='form-row'>
              <div class='col'>
                <label for='openTime'>Horas de contacto</label>
                <span class='form-control-plaintext'><span class='custom-border'>" . $data["horasContacto"] .
          "</span></span>
              </div>
              <div class='col'>
                <label for='studentAnteproyectoUpload'>Archivo Subido</label>
                <div class='input-group'>
                  <div class='input-group-prepend'>
                    <span class='input-group-text' id='studentAnteproyectoUpload'>Archivo</span>
                  </div>
                  <div class='custom-file'>
                    <span class='form-control-plaintext'><span class='custom-border'>\t" . $data["anteproyectoDoc"] .
          "</span></span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class='form-group'>
            <div class='form-row'>
              <div class='col'>
                <label for='companyName'>Empresa</label>
                <span class='form-control-plaintext'><span class='custom-border'>" . $data["companyName"] .
          "</span></span>
              </div>
              <div class='col'>
                <label for='cargo'>Cargo</label>
                <span class='form-control-plaintext'><span class='custom-border'>" . $data["cargo"] . "</span></span>
              </div>
            </div>
          </div>

        </div>
    
<br>
</form>
        
        
        
        ");
      } else {
        echo (" <h2> Usted no tiene asignado ningun alumno :(</h2>");
      }

      ?>

    </div>
  </div>
</div>

<?php
require_once("./footer.php");

?>