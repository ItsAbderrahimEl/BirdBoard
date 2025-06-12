@props(['project'])

<div class="space-y-4" x-data='tasks(@json($project))'>
    <h1 class="text-xl text-muted">Tasks</h1>
    <div class="space-y-3">
        @foreach($project->tasks as $task)
            <x-projects.taskItem :task="$task" />
        @endforeach
    </div>
    <input class="w-full bg-secondary p-4 shadow-md outline-2 focus:outline focus:outline-extra-muted text-muted text-center focus:text-left rounded-lg"
           placeholder="Add some tasks here..."
           x-model="newTask"
           @change="createTask()"
    />
</div>