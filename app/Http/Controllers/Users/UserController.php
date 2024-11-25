<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Resources\User\UserResource;
use App\Http\Services\Users\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $service;
    public function __construct()
    {
        $this->service = new UserService();
    }

    public function subscribeToPlan(Request $request)
    {
        Log::info('UserController | subscribeToPlan', $request->all());
        $data = $this->service->subscribeToPlan($request->all());

        if (empty($data)) {
            return ApiResponse::errorResponse(($data), 'Error updating plan');
        }

        return ApiResponse::successResponse(new UserResource($data), 'Plan Updated successfully');
    }
}
