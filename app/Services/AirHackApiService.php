<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

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

    public function postResult($result)
    {
        try {
            $response = $this->client->post($this->apiUrl.'/submitTasks' , [
                RequestOptions::JSON => $result,
                'headers' => [
                    'Authorization' => 'Bearer jCm8ynTv7gCRDMbmOWZVuw8vhlE47ucV8KeImBa7Zadq5rqatwRSQSu6rSk5'
                ]
            ]);

            return json_decode($response, true);
        } catch(\Exception $exception) {
            return false;
        }
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
