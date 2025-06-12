<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Display a listing of all projects available to the authenticated user.
     */
    public function index(): View
    {
        $projects = Auth::user()->allProjects();
        return view('Projects.index', compact('projects'));
    }

    /**
     * Handle the request to store a new project.
     *
     * Validates the request data for the 'title' and 'description' fields, ensuring
     * they meet the required constraints. If validation passes, a new project is
     * created for the authenticated user. The user is then redirected to the newly
     * created project's path.
     * @return string
     */
    public function store(): string
    {
        $validated = request()->validate([
            'title' => 'required|string|max:100|min:5',
            'description' => 'required|string|min:5',
            'tasks' => 'nullable|array|max:20',
            'tasks.*' => 'string|min:5|max:100'
        ]);

        $project = auth()->user()->projects()
            ->create(Arr::except($validated, 'tasks'));

        if (!empty($validated['tasks']))
            $project->addTasks($validated['tasks']);

        return $project->path();
    }

    /**
     * Display the specified project details.
     *
     * @param  Project  $project  The project instance to be displayed.
     * @return View The view containing the project details.
     * @throws AuthorizationException If the user is not authorized to view the project.
     */
    public function show(Project $project): View
    {
        $this->authorize('view', $project);

        $project->load(['tasks', 'activity']);

        return view('Projects.show', [
            'project' => $project
        ]);
    }

    /**
     * Display the form for editing the specified project.
     *
     * @param  Project  $project  The project to be edited.
     * @return View The view containing the edit form for the project.
     * @throws AuthorizationException If the user is not authorized to view the project.
     */
    public function edit(Project $project): View
    {
        $this->authorize('view', $project);

        return view('Projects.edit', [
            'project' => $project
        ]);
    }

    /**
     * Update the specified project with validated data for the authenticated user.
     * Redirect to the project's path if title or description is modified.
     * Returns null if only notes are updated.
     *
     * @param  Project  $project  The project instance to be updated.
     * @return RedirectResponse|null
     */
    public function update(Project $project): void
    {
        $this->authorize('update', $project);

        $validated = request()->validate([
            'title' => 'sometimes|required|string|min:5|max:100',
            'description' => 'sometimes|required|string|min:5|max:250',
            'notes' => 'sometimes|required|string|min:5|max:500'
        ]);

        $project->update($validated);
    }

    /**
     * Authorize the deletion of the specified project, delete it from the database,
     * and redirect to the projects index route.
     *
     * @param  Project  $project  The project to be deleted.
     * @return RedirectResponse The response redirecting to the projects index route.
     */
    public function destroy(Project $project): RedirectResponse
    {
        $this->authorize('delete', $project);

        $project->delete();

        return redirect()->route('projects.index');
    }
}
