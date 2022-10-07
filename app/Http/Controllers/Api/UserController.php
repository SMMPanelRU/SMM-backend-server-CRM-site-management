<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class UserController
{

    public function emailVerified(Request $request)
    {

        $user = \Auth::user();
        $user->email_verified_at = now();
        $user->save();

    }

    public function me(Request $request)
    {
        return $request->user();
    }
}
