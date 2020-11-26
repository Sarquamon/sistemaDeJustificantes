<?php

include_once "./header.php"

?>

<div class="container">
  <div class="col-lg-12">
    <form action="includes/register_student_inc.php" method="POST">
      <h1>Registro</h1>

      <div class="form-group">
        <div class="form-row">
          <div class="col">
            <label for="controlNumber">Numero de control</label>
            <input type="text" class="form-control" name="controlNumber" id="controlNumber"
              aria-describedby="controlNumberHelp" placeholder="Ingrese su numero de control">
            <small id="controlNumberHelp" class="form-text text-muted">Esta información se mantendrá
              confidencial.</small>
          </div>
          <div class="col">
            <label for="nameInput">Nombre</label>
            <input type="text" class="form-control" name="nameInput" id="nameInput" aria-describedby="nameInputHelp"
              placeholder="Ingrese su nombre">
            <small id="nameInputHelp" class="form-text text-muted">Esta información se mantendrá
              confidencial.</small>
          </div>
          <div class="col">
            <label for="lastnameInput">Apellido</label>
            <input type="text" class="form-control" name="lastnameInput" id="lastnameInput"
              aria-describedby="lastnameInputHelp" placeholder="Ingrese su apellido">
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
              placeholder="Ingrese su email">
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="form-row">
          <div class="col">
            <label for="password">Cree una contraseña</label>
            <input type="password" class="form-control" name="password" id="password"
              placeholder="Ingrese una contraseña">
          </div>
          <div class="col">
            <label for="passwordRepeat">Repita la contraseña</label>
            <input type="password" class="form-control" id="passwordRepeat" name="passwordRepeat"
              placeholder="Repita su contraseña">
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="form-row">
          <div class="col">
            <label for="careerSelect">Ingrese su carrera</label>
            <select id="careerSelect" name="careerSelect" class="form-control">
              <option>Ing. en Sistemas Computacionales</option>
              <option>Ing. en Gestion Empresarial</option>
              <option>Ing. en Mecatrónica</option>
              <option>Ing. en Geociencias</option>
              <option>Ing. en Petrolera</option>
              <option>Ing. en Industrial</option>
              <option>Ing. en Electromecánica</option>
              <option>Ing. en Nanotecnología</option>
              <option>Lic. Contaduría</option>
              <option>Ing. en Electrónica</option>
            </select>
          </div>
          <div class="col">
            <label for="semestreInput">Semestre</label>
            <input type="text" class="form-control" id="semestreInput" name="semestreInput"
              placeholder="Ingrese su semestre">
          </div>
          <div class="col">
            <label for="groupInput">Grupo</label>
            <input type="text" class="form-control" id="groupInput" name="groupInput" placeholder="Ingrese su grupo">
          </div>
        </div>
      </div>

      <button type="submit" name="submit" class="btn btn-primary">Registrarse</button>
    </form>
  </div>
</div>



<?php

include_once "./footer.php"

?>