<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(protected TaskService $taskService) {}

    public function index()
    {
        return response()->json($this->taskService->list(auth()->id()));
    }

    public function show($id)
    {
        return response()->json($this->taskService->get($id, auth()->id()));
    }

    public function store(TaskRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        return response()->json($this->taskService->store($data), 201);
    }

    public function update(TaskRequest $request, $id)
    {
        return response()->json(
            $this->taskService->update($id, auth()->id(), $request->validated())
        );
    }

    public function destroy($id)
    {
        return $this->taskService->delete($id, auth()->id());
    }
}

