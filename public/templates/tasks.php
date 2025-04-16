<?php
ob_start(); ?>

  <h1>Tareas</h1>
  <a href="/new-task" type="button" class="btn btn-primary">Crear tarea</a>

<?php
if (!empty($tasks)): ?>
  <ul>
      <?php
      foreach ($tasks as $task): ?>
        <li><?= $task->getTitle().' - '.$task->getDate(); ?></li>

      <?php
      endforeach; ?>
  </ul>
<?php
endif; ?>

<?php
$content = ob_get_clean();
require 'layout.php';