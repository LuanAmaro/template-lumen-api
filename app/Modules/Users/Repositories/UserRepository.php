<?php

namespace App\Modules\Users\Repositories;

use App\Bootstrap\Http\Repositories\Repository;
use App\Modules\Users\Models\User;

class UserRepository extends Repository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function fetchAll($search = null, $perPage = null)
    {
        return $this->model
            ->newQuery()
            ->orderBy('id', 'DESC')
            ->search($search)
            ->get();
    }
}
