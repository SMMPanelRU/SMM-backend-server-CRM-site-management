<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Services\SiteContainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController
{

    public function register(Request $request)
    {

        $site = app(SiteContainer::class)->getSite();

        if (!$site) {
            abort(401);
        }

        $validatedData = $request->validate([
            'user_id' => 'required|gt:0',
            'name'     => 'required|string|max:255',
            'email'    => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')
                    ->where('site_id', $site->id),
            ],
            'password' => 'required|string|min:8',
        ]);


        $user = User::create([
            'name'     => $validatedData['name'],
            'email'    => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $user->site()->associate($site);

        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user_id'      => $user->id,
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ]);
    }

    public function login(Request $request)
    {

        $site = app(SiteContainer::class)->getSite();

        if (!$site) {
            abort(401);
        }

        $authData = [
            'email'    => $request->get('email'),
            'password' => $request->get('password'),
            'site_id'  => $site->id,
        ];

        if (!Auth::attempt($authData)) {
            return response()->json([
                'message' => 'Invalid login details',
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user_id'      => $user->id,
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ]);
    }


}
