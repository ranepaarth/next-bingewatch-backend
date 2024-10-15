<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\UserResource;
use App\Http\Services\Auth\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    protected $service;
    public function __construct()
    {
        $this->service = new AuthService();
    }

    public function getStarted(Request $request)
    {
        Log::info("AuthController | getStarted", $request->all());

        // $validated = $request->validate([
        //     'email' => 'required|unique:users,email'
        // ]);

        // Log::info("Validated Response",$validated);

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        if ($validator->fails()) {
            Log::info("Validation failed");
            return response()->json($validator->errors(), 422);
        }

        $user = $this->service->getStarted($request->all());
        if (empty($user)) {
            return ApiResponse::errorResponse($user, 'Error occured while saving the user!');
        }
        $token = $user->createToken('bingewatch_get_started')->accessToken;
        $data = [
            'user' => $user,
            'token' => $token
        ];
        Log::info("AuthController | getStarted", $data);
        return ApiResponse::successResponse($data, 'User saved successfully');
    }

    public function getUser()
    {
        $user = Auth::user();
        if (empty($user)) {
            return ApiResponse::errorResponse($user, 'Error fetching User!');
        }

        return ApiResponse::successResponse(new UserResource($user), 'User fetched successfully');
    }

    public function register(RegisterRequest $request)
    {
        $request['password'] = bcrypt($request['password']);
        $user = $this->service->register($request->all());
        if (empty($user)) {
            return ApiResponse::errorResponse($user, 'Error occured while saving the user!');
        }
        $token = $user->createToken('bingewatch_secretId')->accessToken;
        $data = [
            'user' => new UserResource($user),
            'token' => $token
        ];
        return ApiResponse::successResponse($data, 'User registered successfully');
    }
    public function login() {}

    public function logout() {}
}
