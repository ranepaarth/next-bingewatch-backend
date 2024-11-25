<?php


namespace App\Http\Services\Users;

use App\Http\Repositories\Users\UserRepository;

class UserService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function subscribeToPlan($request)
    {
        $user = request()->user();
        $where = [
            'id' => $user->id,
        ];
        $dataToUpdate = [
            'plan_id' => $request['plan_id'],
        ];
        $data = $this->repository->subscribeToPlan($where, $dataToUpdate);

        return $data;
    }
}
