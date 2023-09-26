<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Enums\TaskStatus;
use App\Http\Resources\TaskResource;
use App\Support\Facades\ApiResponder;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskResourceCollection;

class TaskController extends Controller
{
    private $pageSize = 20;

    public function index()
    {
        return ApiResponder::success(new TaskResourceCollection(Task::latest()->paginate($this->pageSize)), __('message.success_retrieve'));
    }

    public function store(TaskStoreRequest $request)
    {
        $task = Task::create($request->validated());
        return ApiResponder::success(new TaskResource($task), __('message.success_create'));
    }

    public function show(int $id)
    {
        $task = Task::findOrFail($id);
        return ApiResponder::success(new TaskResource($task), __('message.success_retrieve'));
    }

    public function update(TaskUpdateRequest $request, int $id)
    {
        $task = Task::findOrFail($id);
        $taskUpdated = $task->update($request->validated());

        if (!$taskUpdated) return ApiResponder::error(__('message.error_update_record'));

        return ApiResponder::success(new TaskResource($task), __('message.success_update'));
    }

    public function destroy(int $id)
    {
        $task = Task::findOrFail($id);
        $taskDeleted = $task->delete();

        if ($taskDeleted) return ApiResponder::error(__('message.error_delete_record'));

        return ApiResponder::success([], __('message.success_delete'));
    }

    public function markAsComplete(int $id)
    {
        $task = Task::findOrFail($id);

        if ($task->status->value == TaskStatus::Open) {
            $taskMarkedAsCompleted = $task->update(['status' => TaskStatus::Completed]);

            if (!$taskMarkedAsCompleted) return ApiResponder::error(__('message.error_update_record'));
        }

        return ApiResponder::success([], __('message.success_mark_as_completed'));
    }
}
