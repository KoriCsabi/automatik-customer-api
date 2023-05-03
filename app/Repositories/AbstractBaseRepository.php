<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractBaseRepository implements RepositoryInterface
{
    public function remove(Model $model): bool 
    {
        return $model->delete();
    }

    public function removeById(int $id): bool
    {
        $model = $this->findById($id);

        return $this->remove($model);
    }
}