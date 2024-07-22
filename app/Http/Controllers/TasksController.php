<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TasksController extends Controller
{
    private function sendResponse($data, $message = null, $status = 200)
    {
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];

        return response()->json($response, $status);
    }

    /**
     * Filter tasks by status
     *
     * @param string $status
     * @return \Illuminate\Http\Response
     */
    public function filterByStatus($status)
    {
        $tasks = Task::where('status', $status)->get();
        return $this->sendResponse(TaskResource::collection($tasks), 'Tarefas recuperadas com sucesso.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return $this->sendResponse(TaskResource::collection($tasks), 'Tarefas recuperadas com sucesso.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->validated());
        return $this->sendResponse(new TaskResource($task), 'Tarefa criada com sucesso.', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return $this->sendResponse(new TaskResource($task), 'Tarefas recuperadas com sucesso.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        return $this->sendResponse(new TaskResource($task), 'Tarefa atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return $this->sendResponse(null, 'Tarefa excluída com sucesso.', 204);
    }
}
