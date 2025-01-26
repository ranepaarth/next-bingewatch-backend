<?php


namespace App\Http\Services\Users;

use App\Http\Repositories\UserProfiles\UserProfilesRepository;
use App\Http\Repositories\Users\UserRepository;

class UserService
{
    protected $repository;
    protected $userProfileRepository;

    public function __construct()
    {
        $this->repository = new UserRepository();
        $this->userProfileRepository = new UserProfilesRepository();
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
        $userProfileData = [
            'user_id' => $user->id,
            'name' => fake()->name()
        ];

        if (empty($data)) {
            return $data;
        }
        $this->userProfileRepository->createProfile($userProfileData);

        return $data;
    }
}
