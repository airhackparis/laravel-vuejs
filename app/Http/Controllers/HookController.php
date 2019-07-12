<?php

namespace App\Http\Controllers;

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
        $taskersCount = $result["taskersCount"];
        $taskers = range(1, 50);

        $tasks = $result["tasks"];
        usort($tasks, array($this, "date_sort"));
        $orderedTaskIds = array_map(function($task) {return $task["id"];}, $tasks);
        $tasksDict = array_combine($orderedTaskIds,$tasks);

        array_walk($tasksDict, array($this, "is_executable"));

        return response()->json($tasksDict);
    }

    public function health()
    {
        return response()->json(['success' => true]);
    }
}
