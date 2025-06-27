<?php
namespace App\Repositories\Interfaces;

interface TaskRepositoryInterface
{
   public function getAllByUser($userId);
    public function find($id);
    public function create(array $data);
    public function update($task, array $data);
    public function delete($id);
}
