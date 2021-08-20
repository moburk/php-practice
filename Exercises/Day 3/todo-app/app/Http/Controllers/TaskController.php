<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Services\TaskService;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function getTasks(Request $request)
    {
        $status = $request->has('status') ? $request->query('status') : null;
        $offset = $request->has('offset') ? $request->query('offset') : 0;
        $limit = $request->has('limit') ? $request->query('limit') : 100;
//        $priority = $request->has('priority') ? $request->query('priority') : null;
        if($status != null)
            return $this->getTasksByStatus($status, $limit, $offset);
        return $this->getAllTasks($limit,$offset);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllTasks($limit, $offset)
    {
        $tasks = $this->taskService->getAllTasks($limit, $offset);
        $description = "Successfully retrieved all tasks";
        if($tasks == null)
            $description = "No tasks added yet";
        return response()->json([
            "data" => $tasks,
            "description" => $description
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createTask(CreateTaskRequest $request)
    {
        $task = $this->taskService->createTask($request);
        if ($task == null) {
            return response()->json([
                'error_code' => 'DATABASE_ERROR',
                'description' => 'Failed to create task'
            ], 500);
        }
        return response()->json([
            'data' => null,
            'description' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTaskById($id)
    {
        return $this->taskService->getTaskById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateTaskStatus(UpdateTaskStatusRequest $request, $id)
    {
        $updated = $this->taskService->updateTaskStatus($request, $id);
        if($updated == false){
            return response()->json([
                'error_code' => 'STATUS_NOT_UPDATED',
                'description' => "Could not update status due to incorrect state transition"
            ], 400);
        }
        return response()->json([
            'data' => null,
            'description' => 'Successfully updated task status'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteTaskById($id)
    {
        $deleted = $this->taskService->deleteTaskById($id);
        if($deleted == false){
            return response()->json([
                'error_code' => 'RESOURCE_NOT_FOUND',
                'description' => "Could not find task $id"
            ], 404);
        }
        return response()->json(['data' => null,
            'description' => 'Successfully deleted task']);
    }

    public function getTasksByStatus(string $status, $limit,  $offset) {
        $tasks = $this->taskService->getTasksByStatus($status, $limit, $offset);
        $description = "Successfully retrieved all tasks that are $status";
        if($tasks == null)
            $description = "No tasks with $status status";
        return response()->json([
            "data" => $tasks,
            "description" => $description
        ]);
    }
}
