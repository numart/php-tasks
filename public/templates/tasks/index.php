<?php
ob_start(); ?>

  <h1>Tareas</h1>
  <a href="/new-task" type="button" class="btn btn-primary">Crear tarea</a>

<?php
if (!empty($tasks)): ?>
  <ul>
      <?php
      foreach ($tasks as $task): ?>
        <li><input type="checkbox" class="task-complete" data-id="<?= $task->getId() ?>">
            <?= $task->getTitle(); ?>
          <a href="/edit-task/<?= $task->getId() ?>">Editar</a>
          <a href="/delete-task/<?= $task->getId() ?>">Borrar</a>
        </li>

      <?php
      endforeach; ?>
  </ul>
<?php
endif; ?>

<?php
$content = ob_get_clean();
require dirname(__DIR__, 1) . '/layout.php';