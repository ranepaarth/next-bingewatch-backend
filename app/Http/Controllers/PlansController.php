<?php

namespace App\Http\Controllers;

use App\Http\Helpers\ApiResponse;
use App\Http\Resources\Plans\PlansResource;
use App\Http\Services\PlansService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PlansController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new PlansService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Log::info('PlansController | index');
        $data = $this->service->fetchPlans();
        return ApiResponse::successResponse(PlansResource::collection($data), 'Plans fetched successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        Log::info('PlansController | index', ['id' => $id]);

        $request['id'] = $id;
        $data = $this->service->fetchSinglePlan($request->all());
        return ApiResponse::successResponse(new PlansResource($data), 'Plan fetched successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
