<?php

declare(strict_types=1);

namespace Numa\Tasks\Tasks;

interface TaskRepositoryInterface {
    public function getAll(): array;
    public function getById(string $id): ?Task;
    public function delete(string $id): bool;
    public function save(Task $task): bool;
}