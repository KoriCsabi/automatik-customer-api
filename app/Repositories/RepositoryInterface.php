<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface RepositoryInterface
{
    public function save(Model $model): Model;

    public function remove(Model $model): bool;

    public function removeById(int $id): bool;

    public function findById(int $id): Model;

    public function findAll(): Collection;
}