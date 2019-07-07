<?php

namespace App\Providers;

use App\Http\Services\AirHackApiService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AirHackApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $apiUrl = Config::get('airhack_api.url');
        $client = new Client();
        $this->app->singleton(AirHackApiService::class, function () use ($apiUrl, $client) {
            return new AirHackApiService($apiUrl, $client);
        });
    }

    public function provides()
    {
        return [AirHackApiService::class];
    }
}