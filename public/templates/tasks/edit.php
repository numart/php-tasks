<?php
/** @var $task \Numa\Tasks\Tasks\Task */

 ob_start();

 ?>

<h1>Editar tarea</h1>

<form action="/task/update/<?= $task->getId(); ?>" method="POST">
    <input type="hidden" name="task_id" value="<?= $task->getId() ?>" />
  <div class="mb-3">
    <label for="task_title" class="form-label">Título</label>
    <input type="text" class="form-control" name="name" id="task_title" value="<?= $task->getTitle() ?>">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php
$content = ob_get_clean();
require dirname(__DIR__, 1) . '/layout.php';