<?php

namespace App\Services;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use function Symfony\Component\Translation\t;

class TaskService
{
    public function createTask(CreateTaskRequest $request)
    {
        $validated = $request->validated();
        $task = Task::create($validated);
        return $task;
    }

    public function getTaskById($id)
    {
        if (gettype($id) != 'integer')
            return response()->json([
                'error_code' => 'RESOURCE_NOT_FOUND',
                'description' => "Task ID in incorrect format"
            ], 404);
        try {
            $task = Task::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error_code' => 'RESOURCE_NOT_FOUND',
                'description' => "Could not find task $id"
            ], 404);
        }
        return response()->json([
            'data' => $task,
            'description' => 'Successfully returned task'
        ]);
    }

    public function getAllTasks($limit, $offset)
    {
        $tasks = Task::offset($offset)->limit($limit)->orderBy('status')->orderBy('priority')->orderBy('deadline')->get();
        return $tasks;
    }

    public function updateTaskStatus(UpdateTaskStatusRequest $request, $id)
    {
        $validated = $request->validated();
        if (gettype($id) != 'integer')
            return false;
        $task = Task::find($id);
        if (($task->status == 'Done') || ($task->status == 'In Progress' && $validated['status'] != 'Done')
            || ($task->status == $validated['status'])) {
            return false;
        }
        $task->status = $validated['status'];
        $task->save();
        return true;
    }

    public function deleteTaskById($id)
    {
        if (gettype($id) != 'integer')
            return false;
        $task = Task::find($id);
        if ($task == null) {
            return false;
        }
        $task->delete();

    }

    public function getTasksByStatus(string $status)
    {
        if ($status != 'Pending' || 'In Progress' || 'Done') {
            return null;
        }
        $task = Task::where('status', $status)
            ->orderBy('priority')
            ->orderBy('deadline')
            ->get();
        return $task;
    }
}
