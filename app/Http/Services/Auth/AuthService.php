<?php

namespace App\Http\Services\Auth;

use App\Http\Repositories\Auth\AuthRepository;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $repository;
    public function __construct()
    {
        $this->repository = new AuthRepository();
    }

    public function getStarted($request)
    {
        // create a user entry into the user database when user enters the email on landing page
        return $this->repository->getStarted($request);
    }

    public function register($request)
    {
        $user = $this->repository->register($request);

        return $user;
    }

    public function checkIfUserExist($request)
    {
        $where = [
            'email' => $request['email']
        ];
        $user = $this->repository->checkIfUserExist($where);
        return $user;
    }

    public function login($request)
    {
        $where = ['email' => $request['email']];
        $user = $this->repository->login($where, $request);
        return $user;
    }

    public function logout() {}
}
