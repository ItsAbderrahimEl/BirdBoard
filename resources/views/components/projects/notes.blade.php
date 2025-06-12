@props(['project'])

<div x-data='notes(@json($project))' class="flex flex-col gap-y-4">
    <h1 class="text-xl text-gray-500 mt-10">General Notes</h1>
    <textarea
            class="w-full h-56 outline-1 focus:outline focus:outline-extra-muted rounded-lg bg-secondary shadow-md p-5 text-muted"
            placeholder="Anything special that you want to make a note of"
            x-model.debounce="project.notes"
    ></textarea>
    <button class="button self-end" @click="updateNotes()">Save</button>
</div>