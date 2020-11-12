<?php

namespace Stack\Repository\Eloquent;

use Stack\Model\User;
use Illuminate\Support\Collection;
use Stack\Repository\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }
}
