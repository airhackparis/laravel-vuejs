<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HookController extends Controller
{
    public function incomingTasks(Request $request)
    {
        Log::info($request->all());

        return response()->json(['success' => true]);
    }

    public function health()
    {
        return response()->json(['success' => true]);
    }
}
