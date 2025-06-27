<?php
namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;


class TaskRepository implements TaskRepositoryInterface
{
    public function getAllByUser($userId)
    {
        return Task::where('user_id', $userId)->get();
    }

    public function find($id)
    {
        return Task::find($id);
    }

    public function create(array $data)
    {
        return Task::create($data);
    }

    public function update($task, array $data)
    {
        $task->update($data);
        return $task;
    }

    public function delete($id)
    {
        return Task::destroy($id);
    }
}
