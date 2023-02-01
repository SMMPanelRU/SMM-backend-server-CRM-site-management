<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GitHub extends Controller
{
    public function webhook(Request $request)
    {
        Log::info(json_encode($request->toArray()));
        echo 'v1'; //testing
    }
}
