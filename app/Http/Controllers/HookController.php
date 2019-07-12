<?php

namespace App\Http\Controllers;

use App\Http\Services\AirHackApiService;
use Illuminate\Http\Request;


class HookController extends Controller
{
    function date_sort($task1, $task2)
    {
        return strtotime($task1["dueTime"]) - strtotime($task2["dueTime"]);
    }

    public function incomingTasks(Request $request)
    {
        $result = $request->all();
        $taskersCount = $result["taskersCount"];
        $taskers = range(1, $taskersCount);

        $tasks = $result["tasks"];
        usort($tasks, array($this, "date_sort"));

        $currentTaskId = 0; // Start with the first task
        $tasks[0]['assignee_id'] = 1;

        $apiService = app(AirHackApiService::class);

        foreach($tasks as $taskIndex => $task) {

            if ($currentTaskId !== $taskIndex) {
                $this->isExecutable(
                    $tasks[$currentTaskId],
                    $tasks[$taskIndex]
                );
                $tasks[$taskIndex]['assignee_id'] = 1;
            }

            $currentTaskId = $taskIndex;
        }

        $result["tasks"] = $tasks;
        $response = $apiService->postResult($result);

        return response()->json($response);
    }

    public function health()
    {
        return response()->json(['success' => true]);
    }

    private function isExecutable($currentTask, $taskToCompare)
    {
        return $this->distance($currentTask['lat'], $currentTask['lng'], $taskToCompare['lat'], $taskToCompare['lng']);
    }

    private function distance($lat1, $lon1, $lat2, $lon2) {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        }
        else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;

            return $miles * 1.60934;
        }
    }
}
