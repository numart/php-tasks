<?php ob_start(); ?>

<h1>Crear tarea</h1>

<form action="/add-task" method="POST">
  <div class="mb-3">
    <label for="task_title" class="form-label">Título</label>
    <input type="text" class="form-control" name="name" id="task_title" placeholder="">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php
$content = ob_get_clean();
require dirname(__DIR__, 1) . '/layout.php';