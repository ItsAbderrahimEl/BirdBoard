<x-general.modal class="w-1/2">
    <x-slot:trigger>
        <button class="button">
            Add Project
        </button>
    </x-slot:trigger>

    <x-slot:title>
        Add Project
    </x-slot:title>

    <x-slot:content>
        <form @submit.prevent="addProject()" x-data="addProject" class="w-full grid grid-cols-2 p-5 gap-x-5">
            @csrf
            <div class="flex flex-col gap-4 col-span-1 text-normal">
                <label class="space-y-3">
                    <span class="font-bold text-normal">Title</span>
                    <input class="w-full rounded p-2 outline-1 bg-extra-muted shadow focus:outline outline-muted"
                           type="text"
                           x-model="title">
                </label>
                <label class="space-y-2">
                    <span class="font-bold text-normal">Description</span>
                    <textarea
                            class="w-full rounded-lg p-4 bg-extra-muted outline-1 shadow-md focus:outline outline-muted"
                            name="description"
                            x-model="description"
                            rows="5"></textarea>
                </label>
                <span id="add_project_errors" class="text-sm text-error"></span>
            </div>
            <div class="col-span-1 flex flex-col gap-y-4">
                <div id="tasks-container" class="font-bold space-y-3">
                    <span class="text-normal">Add Some tasks here:</span>
                </div>
                <button @click.prevent="addTask()"
                        class="inline-flex items-center gap-x-1.5 self-end text-normal hover:text-muted">
                    <img class="size-5" src="{{ asset('images/add_task.png') }}" alt="Add task Icon">
                    Add a task
                </button>
            </div>
            <button class="button self-end col-span-2 mt-10 w-1/2 m-auto">
                Save Project
            </button>
        </form>
    </x-slot:content>
</x-general.modal>