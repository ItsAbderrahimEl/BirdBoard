<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;

class TaskController extends Controller
{
    public function store(Project $project)
    {
        $this->authorize('store', $project);

        $validated = request()->validate([
            'body' => 'required|string|max:100|min:3',
        ]);

        $project->addtask($validated);

        return redirect($project->path());
    }

    public function update(Task $task)
    {
        $this->authorize('update', $task);

        $validated = request()->validate([
            'body' => 'sometimes|required|string|max:100|min:3',
            'complete' => 'sometimes|required|boolean',
        ]);

        $task->update($validated);
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();
    }
}
