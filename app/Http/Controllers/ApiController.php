<?php

namespace App\Http\Controllers;

use App\Http\Services\AirHackApiService;

class ApiController extends Controller
{
    public function tasks()
    {
        return response()->json([
            [ 'id' => 1, 'time' => 123456789 ],
            [ 'id' => 2, 'time' => 123456789 ],
            [ 'id' => 3, 'time' => 123456789 ],
        ]);
    }

    public function airHackApiHealth()
    {
        $apiService = app(AirHackApiService::class);

        return response()->json(['health' => $apiService->checkHealth()]);
    }
}
