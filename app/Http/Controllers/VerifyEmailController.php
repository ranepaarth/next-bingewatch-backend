<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VerifyEmailController extends Controller
{
    public function __invoke(Request $request)
    {
        Log::info('CLIENT_URL', ['url' => config('app.client_url')]);
        $user = User::find($request->route('id'));

        if ($user->hasVerifiedEmail()) {
            return redirect(config('app.client_url') . '/signup/planform');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
            return redirect(config('app.client_url') . '/signup/planform');
        }

        return redirect(config('app.client_url'));
    }
}
