<?php

namespace App\Http\Repositories\Users;

use App\Models\User;

class UserRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function subscribeToPlan($where, $dataToUpdate)
    {
        $user = $this->model->where($where)->first();
        if (!empty($user)) {
            $user->update($dataToUpdate);
            return $user->refresh();
        }

        return $user;
    }
}
