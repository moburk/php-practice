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
    protected $statusEnum = array(
        'Pending' => 0,
        'In Progress' => 1,
        'Done' => 2
    );


    public function createTask(CreateTaskRequest $request)
    {
        $validated = $request->validated();
        $task = Task::create($validated);
        return $task;
    }

    public function getTaskById($id)
    {
        if (is_numeric($id) == false)
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
        $tasks = Task::offset($offset)
            ->limit($limit)
            ->orderBy('status')
            ->orderBy('priority')
            ->orderBy('deadline')
            ->get();

        return $tasks;
    }

    public function updateTaskStatus(UpdateTaskStatusRequest $request, $id)
    {
        $validated = $request->validated();

        if (is_numeric($id) == false)
            return false;

        $task = Task::find($id);
        if($task == null)
            return false;

        if($this->statusEnum[$task->status] >= $this->statusEnum[$validated['status']]) {
            return false;
        }
        $task->status = $validated['status'];

        $task->save();
        return true;
    }

    public function deleteTaskById($id)
    {
        if (is_numeric($id) == false)
            return false;
        $task = Task::find($id);
        if ($task == null) {
            return false;
        }
        $task->delete();
        return true;
    }

    public function getTasksByStatus(string $status, $limit, $offset)
    {
        if (array_key_exists($status, $this->statusEnum) == false) {
            return null;
        }
        $task = Task::where('status', $status)
            ->offset($offset)
            ->limit($limit)
            ->orderBy('priority')
            ->orderBy('deadline')
            ->get();
        return $task;
    }
}
