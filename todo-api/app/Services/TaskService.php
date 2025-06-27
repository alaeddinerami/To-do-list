<?php
namespace App\Services;

use App\Repositories\Interfaces\TaskRepositoryInterface;

class TaskService
{
    public function __construct(protected TaskRepositoryInterface $TaskRepository) {}

    public function list($userId)
    {
        try {
            return $this->TaskRepository->getAllByUser($userId);
        } catch (\Exception $e) {
            logger()->error('List tasks failed: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to list tasks'], 500);
        }
    }

    public function get($id, $userId)
    {
        try {
            $task = $this->TaskRepository->find($id);
            if (!$task || $task->user_id !== $userId) {
                return response()->json(['error' => 'Not found or unauthorized'], 404);
            }
            return $task;
        } catch (\Exception $e) {
            logger()->error('Get task failed: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to retrieve task'], 500);
        }
    }

  public function store(array $data)
{
    try {
        return $this->TaskRepository->create($data);
    } catch (\Exception $e) {
        logger()->error('Create task failed', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'data' => $data,
        ]);
        return response()->json(['error' => 'Unable to create tasks'], 500);
    }
}

    public function update($id, $userId, array $data)
    {
        try {
            $task = $this->TaskRepository->find($id);
            if (!$task || $task->user_id !== $userId) {
                return response()->json(['error' => 'Not found or unauthorized'], 403);
            }
            return $this->TaskRepository->update($task, $data);
        } catch (\Exception $e) {
            logger()->error('Update task failed: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to update task'], 500);
        }
    }

    public function delete($id, $userId)
    {
        try {
            $task = $this->TaskRepository->find($id);
            if (!$task || $task->user_id !== $userId) {
                return response()->json(['error' => 'Not found or unauthorized'], 403);
            }
            return $this->TaskRepository->delete($id);
        } catch (\Exception $e) {
            logger()->error('Delete task failed: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to delete task'], 500);
        }
    }
}

