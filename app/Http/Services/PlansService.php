<?php

namespace App\Http\Services;

use App\Http\Repositories\PlansRepository;

class PlansService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new PlansRepository();
    }

    public function fetchPlans()
    {
        $data = $this->repository->fetchPlans();
        return $data;
    }

    public function fetchSinglePlan($request)
    {
        $where = [
            'id' => $request['id']
        ];
        $data = $this->repository->fetchSinglePlan($where);
        return $data;
    }
}
