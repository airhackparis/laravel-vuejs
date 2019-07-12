<?php

namespace App\Http\Controllers;

use App\Http\Services\AirHackApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HookController extends Controller
{
    function date_sort($task1, $task2)
    {
        return strtotime($task1["dueTime"]) - strtotime($task2["dueTime"]);
    }

    public function incomingTasks(Request $request)
    {

        $result = $request->all();

        $tasks = $result["tasks"];
        usort($tasks, array($this, "date_sort"));

        $currentTaskId = 0; // Start with the first task

        $taskersCount = $result["taskersCount"];
        $taskersCurrentTask = array_fill(0, $taskersCount-1, null);

        $tasks[0]['assignee_id'] = 1;
        $taskersCurrentTask[1] = $tasks[$currentTaskId];

        foreach ($tasks as $taskIndex => $task) {
            if ($currentTaskId !== $taskIndex) {
                foreach ($taskersCurrentTask as $tasker => $currentTaskerTask) {
                    if ($currentTaskerTask == null || $this->isExecutable(
                        $currentTaskerTask,
                        $tasks[$taskIndex]
                    )) {
                        $tasks[$taskIndex]['assignee_id'] = $tasker;
                        $taskersCurrentTask[$tasker] = $tasks[$taskIndex];
                        break;
                    }
                }
            }

            $currentTaskId = $taskIndex;
        }

        $result["tasks"] = $tasks;
        $apiService = app(AirHackApiService::class);
        $response = $apiService->postResult($result);
        return response()->json($response);
    }

    public function health()
    {
        return response()->json(['success' => true]);
    }

    private function isExecutable($currentTask, $taskToCompare)
    {
        $time2 = ($this->distance($currentTask['lat'], $currentTask['lng'], $taskToCompare['lat'], $taskToCompare['lng']) / 10);
        $timeToGo = sprintf('%02d:%02d', (int) $time2, fmod($time2, 1) * 60);

        $secs = strtotime($timeToGo) - strtotime("00:00:00");
        $result = date("H:i:s", strtotime($currentTask["dueTime"] . '+ 30 minutes') + $secs);

        return (new \DateTime($result) < new \DateTime($taskToCompare['dueTime']));
    }

    private function distance($lat1, $lon1, $lat2, $lon2)
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;

            return $miles * 1.60934;
        }
    }
}
