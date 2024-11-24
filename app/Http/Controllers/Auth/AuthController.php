<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Services\Auth\AuthService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

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

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        if ($validator->fails()) {
            Log::info("Validation failed");
            return response()->json($validator->errors(), 422);
        }

        $user = $this->service->getStarted($request->all());
        if (empty($user)) {
            return ApiResponse::errorResponse($user, 'Error occurred while searching for the user!');
        }
        $token = $user->createToken('bingewatch_get_started')->accessToken;
        $data = [
            'user' => $user,
            'token' => $token
        ];
        Log::info("AuthController | getStarted", $data);
        $response = new Response($data);
        $response->withCookie(cookie(
            'bingewatch_get_started', // Cookie name
            $token, // Cookie value
            1440, // Minutes until expiration
            '/', // Path (root of the application)
            null, // Domain (null should work for localhost)
            false, // Secure (set to false for HTTP)
            false, // HttpOnly
            'Lax' // SameSite policy (you can also try 'Strict')
        ));
        return $response;
    }

    public function register(Request $request)
    {
        Log::info("AuthController | register", $request->all());

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', Password::min(8)]
        ]);

        if ($validator->fails()) {
            Log::info("Validation failed");
            return response()->json($validator->errors(), 422);
        }

        $user = $this->service->register($request->all());
        if (empty($user)) {
            return ApiResponse::errorResponse($user, 'Error occured while saving the user!');
        }
        $token = $user->createToken('bingewatchToken')->accessToken;
        $data = [
            'user' => $user,
            'token' => $token
        ];
        event(new Registered($user));
        $user->sendEmailVerificationNotification();
        Log::info("AuthController | register", $data);
        return ApiResponse::successResponse(['token' => $token, 'user' => $user], 'Registered in successfully');
    }

    public function checkIfUserExist(Request $request)
    {
        $user = $this->service->checkIfUserExist($request->all());

        return ApiResponse::successResponse($user, 'User details fetched successfully');
    }

    public function login(Request $request)
    {
        Log::info('Login User', $request->all());

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('bingewatchSecureId')->accessToken;
            return ApiResponse::successResponse(['token' => $token, 'user' => $user], 'Logged in successfully');
        } else {
            return ApiResponse::errorResponse(null, 'User does not exist', 404);
        }
    }

    public function getUser(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return ApiResponse::errorResponse(null, 'Unauthorized access blocked', 401);
        }

        return ApiResponse::successResponse($user, 'User retrieved successfully');
    }


    public function logout(Request $request)
    {
        try {
            // Retrieve the currently authenticated user's token
            $token = $request->user()->token();

            // Revoke the token to make it invalid
            $token->revoke();

            // Clear the cookie
            $response = ApiResponse::successResponse(null, 'User logged out successfully');
            $response->withCookie(cookie()->forget('bingewatchSecureId'));

            Log::info('User logged out successfully', ['user_id' => $request->user()->id]);
            return $response;
        } catch (\Exception $e) {
            Log::error('Error during logout', ['error' => $e->getMessage()]);
            return ApiResponse::errorResponse(null, 'An error occurred while logging out', 500);
        }
    }
}
