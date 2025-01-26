<?php

namespace App\Http\Controllers\UserProfiles;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Requests\UserProfiles\CreateProfileRequest;
use App\Http\Resources\UserProfiles\UserProfilesResource;
use App\Http\Services\UserProfiles\UserProfilesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserProfilesController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new UserProfilesService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->service->fetchAllProfiles();
        return ApiResponse::successResponse($data, 'User Profiles fetched successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) {}
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProfileRequest $request)
    {
        Log::info('UserProfileController | createProfile', $request->all());
        $data = $this->service->createProfile($request->all());
        // dd($data);
        if (!empty($data)) {
            return ApiResponse::successResponse(new UserProfilesResource($data), 'User Profile created successfully');
        }

        return ApiResponse::errorResponse(null, 'Maximum number of Profiles created', 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
