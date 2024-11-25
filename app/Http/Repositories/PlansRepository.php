<?php

namespace App\Http\Repositories;

use App\Models\Plans;

class PlansRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Plans();
    }

    public function fetchPlans()
    {
        $plans = $this->model->get();
        return $plans;
    }

    public function fetchSinglePlan($where)
    {
        $plan = $this->model->where($where)->first();
        return $plan;
    }
}
