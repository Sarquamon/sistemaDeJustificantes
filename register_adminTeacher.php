<?php

include_once "./header.php"

?>

<div class="container">
  <div class="col-lg-12">
    <form action="includes/register_adminTeacher_inc.php" method="POST">
      <h1>Registro administradores y maestros</h1>

      <div class="form-group">
        <div class="form-row">
          <div class="col">
            <label for="controlNumber">Numero de control</label>
            <input type="text" class="form-control" name="controlNumber" id="controlNumber" aria-describedby="controlNumberHelp" placeholder="Ingrese su numero de control">
            <small id="controlNumberHelp" class="form-text text-muted">Esta información se mantendrá
              confidencial.</small>
          </div>
          <div class="col">
            <label for="nameInput">Nombre</label>
            <input type="text" class="form-control" name="nameInput" id="nameInput" aria-describedby="nameInputHelp" placeholder="Ingrese su nombre">
            <small id="nameInputHelp" class="form-text text-muted">Esta información se mantendrá
              confidencial.</small>
          </div>
          <div class="col">
            <label for="lastnameInput">Apellido</label>
            <input type="text" class="form-control" name="lastnameInput" id="lastnameInput" aria-describedby="lastnameInputHelp" placeholder="Ingrese su apellido">
            <small id="lastnameInputHelp" class="form-text text-muted">Esta información se mantendrá
              confidencial.</small>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="form-row">
          <div class="col">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Ingrese su email">
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="form-row">
          <div class="col-5">
            <label for="password">Cree una contraseña</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Ingrese una contraseña">
          </div>
          <div class="col-5">
            <label for="passwordRepeat">Repita la contraseña</label>
            <input type="password" class="form-control" id="passwordRepeat" name="passwordRepeat" placeholder="Repita su contraseña">
          </div>
          <div class="col-2">
            <label for="userType">Tipo de usuario</label>
            <select id="userType" name="userType" class="form-control">
              <option>Maestro</option>
              <option>Administrador</option>
            </select>
          </div>
        </div>
      </div>

      <button type="submit" name="submit" class="btn btn-outline-primary">Registrar Maestro</button>
    </form>
  </div>
</div>



<?php

include_once "./footer.php"

?>