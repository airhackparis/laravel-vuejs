<?php

namespace App\Http\Services;

use GuzzleHttp\Client;

class AirHackApiService
{
    protected $apiUrl;

    /** @var Client */
    protected $client;

    public function __construct($apiUrl, Client $client)
    {
        $this->apiUrl = $apiUrl;
        $this->client = $client;
    }

    public function submitTasks()
    {

    }

    public function checkHealth()
    {
        try {
            $response = $this->client->request('GET', $this->apiUrl.'/health');

            return json_decode($response->getBody(), true)['success'] === "true";
        } catch(\Exception $exception) {
            return false;
        }
    }
}
