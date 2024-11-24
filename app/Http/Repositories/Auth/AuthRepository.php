<?php

namespace App\Http\Repositories\Auth;

use App\Http\Helpers\ApiResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{
    protected $model;
    public function __construct()
    {
        $this->model = new User();
    }

    public function getStarted($data)
    {
        return $this->model->create($data);
    }

    public function register($data)
    {
        $user = $this->model->create($data);
        return $user;
    }

    public function checkIfUserExist($where)
    {
        $user = $this->model->where($where)->first();

        return $user;
    }

    public function login($where, $request)
    {
        $data = $this->model->where($where)->first();
        if (Hash::check($request['password'], $data->password)) {
            return $data;
        } else {
            return null;
        }
    }
}
