@props(['project'])

<x-general.modal class="w-1/3">
    <x-slot:trigger>
        <button class="button">
            Edit Project
        </button>
    </x-slot:trigger>

    <x-slot:title>
        Edit: {{ $project->title }}
    </x-slot:title>

    <x-slot:content>
        <form @submit.prevent="editProject()" x-data='editProject(@json($project))'
              class="w-full grid grid-cols-1 place-items-center p-5 gap-x-5">
            @csrf
            <div class="flex flex-col gap-4  w-full m-auto  text-normal">
                <label class="space-y-3">
                    <span class="font-bold text-normal">Title</span>
                    <input class="w-full rounded p-2 outline-1 bg-extra-muted shadow focus:outline outline-muted "
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
                <span id="edit_project_errors" class="text-sm text-error"></span>
            </div>
            <button class="button self-end col-span-2 mt-10 w-1/2 m-auto">
                Save
            </button>
        </form>
    </x-slot:content>
</x-general.modal>