<?php

namespace Stack\Repository\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Stack\Repository\EloquentRepositoryInterface;

class BaseRepository implements EloquentRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
 
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }
 
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }
}
