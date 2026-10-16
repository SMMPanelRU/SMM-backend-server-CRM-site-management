<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Users\LoginRequest;
use App\Http\Requests\Users\RegisterRequest;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\SiteContainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController
{

    public function register(RegisterRequest $request)
    {
        $site = app(SiteContainer::class)->getSite();

        if (!$site) {
            abort(401);
        }

        $validatedData = $request->validated();

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $user->site()->associate($site);

        $user->save();

        if (!empty($validatedData['profile'])) {
            foreach ($validatedData['profile'] as $key => $value) {
                $userProfile = UserProfile::create([
                    'user_id' => $user->id,
                    'key' => $key,
                    'value' => $value,
                ]);
            }
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user_id' => $user->id,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function login(LoginRequest $request)
    {
        $site = app(SiteContainer::class)->getSite();

        if (!$site) {
            return response()->json([
                'message' => 'Site not found',
            ], 401);
        }

        $validatedData = $request->validated();

        $authData = [
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'site_id' => $site->id,
        ];

        if (!Auth::attempt($authData)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        $user = User::where([
            'email' => $validatedData['email'],
            'site_id' => $site->id
        ])->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 401);
        }

        // Revoke all existing tokens for security
        $user->tokens()->delete();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user_id' => $user->id,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }


}
