<?php

require_once("./header.php");

?>

<div class="container">
  <br>
  <div class="row">
    <div class="col">

      <form action="./includes/uploadAnteproyectoStudent_inc.php" method="POST" enctype="multipart/form-data">

        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="studentAnteproyectoUpload">Upload</span>
          </div>
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="studentAnteproyectoUpload" name="studentAnteproyectoUpload"
              aria-describedby="studentAnteproyectoUpload">
            <label class="custom-file-label" for="studentAnteproyectoUpload">Choose file</label>
          </div>
        </div>
        <br>
        <button type="submit" name="submit" class="btn btn-primary">Enviar</button>
      </form>


    </div>
  </div>
</div>




<?php

require_once("./footer.php");

?>