<?php

require_once("./header.php");

?>

<div class="container">
  <br>
  <div class="row">
    <div class="col">
      <?php
      include_once("./includes/check_students.php");
      if ($data = userHasAsesor($controlNumber)) {

        if ($data["contactNumber"] == "") {
          $data["contactNumber"] = "N/A";
        } else if ($data["email"] == "") {
          $data["email"] = "N/A";
        };

        echo ("
        
        
        <form action='./includes/uploadAnteproyectoStudent_inc.php' method='POST' enctype='multipart/form-data'>

        <div class='form-group'>
          <div class='form-row'>
            <div class='col'>
              <label for='externalAsesor'>Nombre(s)</label>
              <input type='text' readonly class='form-control-plaintext' id='staticNombre' value='" . $data["nombreAsesor"] . "'>
            </div>
            <div class='col'>
              <label for='nameInput'>Apellido Paterno</label>
              <input type='text' readonly class='form-control-plaintext' id='staticName' value='" . $data["nameAsesorInt"] . "'>
            </div>
            <div class='col'>
              <label for='lastnameInput'>Apellido Materno</label>
              <input type='text' readonly class='form-control-plaintext' id='staticName' value='" . $data["lastNameMaestro"] . "'>
            </div>
          </div>
        </div>

        <div class='form-group'>
          <div class='form-row'>
            <div class='col'>
              <label for='email'>Email</label>
              <input type='text' readonly class='form-control-plaintext' id='staticName' value='" . $data["email"] . "'>
            </div>
            <div class='col'>
              <label for='phone'>Teléfono</label>
              <input type='text' readonly class='form-control-plaintext' id='staticName' value='" . $data["contactNumber"] . "'>
            </div>
          </div>
        </div>

        <div class='form-group'>
          <div class='form-row'>
            <div class='col'>
              <label for='openTime'>Horas de contacto</label>
              <input type='text' readonly class='form-control-plaintext' id='staticName' value='" . $data["horasContacto"] . "'>
            </div>

            <div class='col'>

            <label for='studentAnteproyectoUpload'>Archivo Subido</label>
              <div class='input-group'>
                <div class='input-group-prepend'>
                  <span class='input-group-text' id='studentAnteproyectoUpload'>Archivo</span>
                </div>
                <div class='custom-file'>
                  <input type='text' readonly class='form-control-plaintext' id='staticName' value='\t" . $data["anteproyectoDoc"] . "'>
                </div>
              </div>

            </div>

          </div>

        </div>

        <div class='form-group'>
          <div class='form-row'>
            <div class='col'>
              <label for='companyName'>Empresa</label>
              <input type='text' readonly class='form-control-plaintext' id='staticName' value='" . $data["companyName"] . "'>
            </div>
            <div class='col'>
              <label for='cargo'>Cargo</label>
              <input type='text' readonly class='form-control-plaintext' id='staticName' value='" . $data["cargo"] . "'>
            </div>
          </div>
        </div>



        <br>
        
      </form>

        ");

        // <button type='submit' name='submit' class='btn btn-primary'>Enviar</button>
      } else {
      ?>
      <form action="./includes/uploadAnteproyectoStudent_inc.php" method="POST" enctype="multipart/form-data">

        <div class="form-group">
          <div class="form-row">
            <div class="col">
              <label for="externalAsesor">Nombre(s)</label>
              <input type="text" class="form-control" name="externalAsesor" id="externalAsesor"
                aria-describedby="externalAsesorHelp" placeholder="Ingrese el nombre de su asesor de la empresa">
              <small id="externalAsesorHelp" class="form-text text-muted">Esta información se mantendrá
                confidencial.</small>
            </div>
            <div class="col">
              <label for="nameInput">Apellido Paterno</label>
              <input type="text" class="form-control" name="nameInput" id="nameInput" aria-describedby="nameInputHelp"
                placeholder="Ingrese el apellido paterno de su asesor de la empresa">
              <small id="nameInputHelp" class="form-text text-muted">Esta información se mantendrá
                confidencial.</small>
            </div>
            <div class="col">
              <label for="lastnameInput">Apellido Materno</label>
              <input type="text" class="form-control" name="lastnameInput" id="lastnameInput"
                aria-describedby="lastnameInputHelp"
                placeholder="Ingrese el apellido materno de su asesor de la empresa">
              <small id="lastnameInputHelp" class="form-text text-muted">Esta información se mantendrá
                confidencial.</small>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="form-row">
            <div class="col">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp"
                placeholder="Ingrese el email de su asesor de la empresa">
            </div>
            <div class="col">
              <label for="phone">Teléfono</label>
              <input type="text" class="form-control" name="phone" id="phone" aria-describedby="phoneHelp"
                placeholder="Ingrese el numero de teléfono de su asesor de la empresa">
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="form-row">
            <div class="col">
              <label for="openTime">Horas de contacto</label>
              <div class="input-group">
                <div class="input-group-append">
                  <input type="text" class="form-control" id="openTime" name="openTime" aria-label="openTime">
                </div>
                <select class="input-group-text" name="ampmOpenTime" id="inputGroupSelect01">
                  <option value="AM" selected>AM</option>
                  <option value="PM">PM</option>
                </select>

              </div>
            </div>
            <div class="col">
              <div class="input-group">
                <div class="input-group-append">
                  <input type="text" class="form-control" id="closeTime" name="closeTime" aria-label="closeTime">
                </div>
                <select class="input-group-text" name="ampmCloseTime" id="inputGroupSelect01">
                  <option value="AM" selected>AM</option>
                  <option value="PM">PM</option>
                </select>

              </div>
            </div>

            <div class="col">


              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="studentAnteproyectoUpload">Subir</span>
                </div>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="studentAnteproyectoUpload"
                    name="studentAnteproyectoUpload" aria-describedby="studentAnteproyectoUpload">
                  <label class="custom-file-label" for="studentAnteproyectoUpload">Elige un archivo</label>
                </div>
              </div>

            </div>

          </div>

        </div>

        <div class="form-group">
          <div class="form-row">
            <div class="col">
              <label for="companyName">Empresa</label>
              <input type="text" class="form-control" name="companyName" id="companyName"
                aria-describedby="companyNameHelp" placeholder="Ingrese el nombre de la empresa">
              <small id="companyNameHelp" class="form-text text-muted">Esta información se mantendrá
                confidencial.</small>
            </div>
            <div class="col">
              <label for="cargo">Cargo</label>
              <input type="text" class="form-control" name="cargo" id="cargo" aria-describedby="cargoHelp"
                placeholder="Ingrese el cargo de su asesor de la empresa">
              <small id="cargoHelp" class="form-text text-muted">Esta información se mantendrá
                confidencial.</small>
            </div>
          </div>
        </div>



        <br>
        <button type="submit" name="submit" class="btn btn-primary">Enviar</button>
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