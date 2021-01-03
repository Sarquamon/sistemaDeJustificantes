<?php

include_once "./header.php"

?>

<div class="container">
  <div class="col-lg-12">
    <form action="includes/login_adminTeacher_inc.php" method="POST">
      <h1>¡Bienvenido de regreso profe!</h1>
      <div class="form-group">
        <label for="controlNumber">Numero de control</label>
        <input type="text" class="form-control" name="controlNumber" id="controlNumber" aria-describedby="emailHelp" placeholder="Ingrese su numero de control">
        <small id="controlNumberHelp" class="form-text text-muted">Esta información se mantendrá confidencial.</small>
      </div>
      <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Ingrese una contraseña">
      </div>
      <button type="submit" name="submit" class="btn btn-outline-primary">Iniciar Sesión</button>
    </form>
  </div>
</div>

<?php

include_once "./footer.php"

?>