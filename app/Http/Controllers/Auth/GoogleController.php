<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Socialite;

class GoogleController extends Controller
{
    /**
     * Summery: Create a new controller instance.
     *
     * @return RedirectResponse
     */
    public function redirectToGoogle()
    {
        try {
            return Socialite::driver('google')->redirect();

        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return redirect()->back();

        }
    }

    /**
     * Summery: Create a new controller instance.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::updateOrCreate([
                'email' => $googleUser->email,
            ], [
                'name' => $googleUser->name,
                'google_id' => $googleUser->id,
                'password' => Hash::make(Str::random(24))
            ]);

            Auth::login($user, true);

            return redirect('/home');

        } catch (Exception $exception) {
            Log::info($exception->getMessage());

            return redirect()->back();
        }
    }
}
