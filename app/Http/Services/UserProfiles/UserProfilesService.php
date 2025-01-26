<?php

namespace App\Http\Services\UserProfiles;

use App\Http\Helpers\ApiResponse;
use App\Http\Repositories\UserProfiles\UserProfilesRepository;
use App\Http\Resources\UserProfiles\UserProfilesResource;
use App\Models\User;

class UserProfilesService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new UserProfilesRepository();
    }

    public function fetchAllProfiles()
    {
        $user = request()->user();
        $where = [
            'user_id' => $user->id,
        ];
        $profiles = $this->repository->fetchAllProfiles($where);
        $profilesCount = $profiles->count();

        return [
            'profiles' => UserProfilesResource::collection($profiles),
            'count' => $profilesCount
        ];
    }

    public function createProfile($request)
    {
        $userId = request()->user()->id;
        $dataToCreate = [
            'user_id' => request()->user()->id,
            'name' => $request['name'],
        ];
        if ($this->getProfileCount($userId) < 5) {
            $data = $this->repository->createProfile($dataToCreate);
            return $data;
        }

        return null;
    }

    public function editProfile() {}

    public function deleteProfile() {}

    public function getProfileCount($userId)
    {
        $where = [
            'user_id' => $userId
        ];

        return $this->repository->getProfileCount($where);
    }
}
