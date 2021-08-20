<?php

namespace App\Services;

use App\Http\Requests\CreateTaskRequest;
use App\Models\Task;

class TaskService
{
    public function createTask(CreateTaskRequest $request)
    {
        $validated = $request->validated();
        $task = new Task;
        foreach ($validated as $key => $value) {
            $task->$key = $value;
        }
        $task->save();
    }
}
