<?php

namespace App\Http\Repositories\UserProfiles;

use App\Models\UserProfile;

class UserProfilesRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new UserProfile();
    }

    public function fetchAllProfiles($where)
    {
        return $this->model->where($where)->orderBy('created_at','desc')->get();
    }

    public function createProfile($dataToCreate)
    {
        $data = $this->model->create($dataToCreate);
        return $data;
    }

    public function editProfile() {}

    public function deleteProfile() {}

    public function getProfileCount($where)
    {
        $data = $this->model->where($where)->count();
        return $data;
    }
}
