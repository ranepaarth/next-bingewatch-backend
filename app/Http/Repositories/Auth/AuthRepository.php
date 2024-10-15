<?php

namespace App\Http\Repositories\Auth;

use App\Models\User;

class AuthRepository
{
    protected $model;
    public function __construct()
    {
        $this->model = new User();
    }

    public function register($where, $data)
    {
        $user = $this->model->where($where)->first();
        if (!empty($user)) {
            $user->update($data);
            return $user->refresh();
        }

        return null;
    }

    public function getStarted($data)
    {
        return $this->model->create($data);
    }
}
