<?php

require_once("./header.php");

?>

<div class="container">
  <br>
  <div class="row">
    <div class="col">
      <?php

      include_once("./includes/userHasAsesorInt.php");
      include_once("./includes/userHasAsesorExt.php");

      if ($data = userHasAsesorExt($controlNumber)) {
        if ($data["contactNumber"] == "") {
          $data["contactNumber"] = "N/A";
        } else if ($data["email"] == "") {
          $data["email"] = "N/A";
        };
      ?>

      <form action='./includes/uploadAnteproyectoStudent_inc.php' method='POST' enctype='multipart/form-data'>

        <h1>Asesor Externo</h1>
        <div class='container-fluid studentInfo'>
          <div class='form-group'>
            <div class='form-row'>
              <div class='col'>
                <label for='externalAsesor'>Nombre(s)</label>
                <span class='form-control-plaintext'><span
                    class='custom-border'><?php echo ($data["nombreAsesor"]) ?></span></span>
              </div>
              <div class='col'>
                <label for='nameInput'>Apellido Paterno</label>
                <span class='form-control-plaintext'><span
                    class='custom-border'><?php echo ($data["nameAsesorInt"]) ?></span></span>
              </div>
              <div class='col'>
                <label for='lastnameInput'>Apellido Materno</label>
                <span class='form-control-plaintext'><span
                    class='custom-border'><?php echo ($data["lastNameMaestro"]) ?></span></span>
              </div>
            </div>
          </div>
          <div class='form-group'>
            <div class='form-row'>
              <div class='col'>
                <label for='email'>Email</label>
                <span class='form-control-plaintext'><span
                    class='custom-border'><?php echo ($data["email"]) ?></span></span>
              </div>
              <div class='col'>
                <label for='phone'>Teléfono</label>
                <span class='form-control-plaintext'><span
                    class='custom-border'><?php echo ($data["contactNumber"]) ?></span></span>
              </div>
            </div>
          </div>
          <div class='form-group'>
            <div class='form-row'>
              <div class='col'>
                <label for='openTime'>Horas de contacto</label>
                <span class='form-control-plaintext'><span
                    class='custom-border'><?php echo ($data["horasContacto"]) ?></span></span>
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
          <div class='form-group'>
            <div class='form-row'>
              <div class='col'>
                <label for='companyName'>Empresa</label>
                <span class='form-control-plaintext'><span
                    class='custom-border'><?php echo ($data["companyName"]) ?></span></span>
              </div>
              <div class='col'>
                <label for='cargo'>Cargo</label>
                <span class='form-control-plaintext'><span
                    class='custom-border'><?php echo ($data["cargo"]) ?></span></span>
              </div>
            </div>
          </div>
        </div>
        <h1>Asesor Interno</h1>

        <?php

          if ($info = userHasAsesorInt($controlNumber)) {
          ?>
        <div class='container-fluid studentInfo'>
          <div class='form-group'>
            <div class='form-row'>
              <div class='col'>
                <label for='companyName'>Maestro asignado</label>
                <span class='form-control-plaintext'><span
                    class='custom-border'><?php echo ($info["name"] . " " . $info["lastname"]) ?></span></span>
              </div>
              <div class='col'>
                <label for='cargo'>Contacto</label>
                <span class='form-control-plaintext'><span
                    class='custom-border'><?php echo ($info["maestroEmail"]) ?></span></span>
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
              <h2>No se te ha asignado un maestro</h2>
            </div>
          </div>
        </div>
      </div>
      <br>

      </form>

      <?php
          }
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
              <label for="openTime">Contactar desde:</label>
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
              <label for="closeTime">Contactar hasta:</label>
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

              <label for="studentAnteproyectoUploadspan">Subir Documento</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="studentAnteproyectoUploadspan">Subir</span>
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
        <button type="submit" name="submit" class="btn btn-outline-primary">Enviar</button>
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