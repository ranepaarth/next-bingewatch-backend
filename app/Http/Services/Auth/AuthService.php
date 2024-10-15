<?php

namespace App\Http\Services\Auth;

use App\Http\Repositories\Auth\AuthRepository;

class AuthService
{
    protected $repository;
    public function __construct()
    {
        $this->repository = new AuthRepository();
    }

    public function register($request)
    {
        $where = ['id' => $request['id']];
        return $this->repository->register($where, $request);
    }

    public function getStarted($request)
    {
        // create a user entry into the user database when user enters the email on landing page
        return $this->repository->getStarted($request);
    }

    public function login() {}

    public function logout() {}
}
