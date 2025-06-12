@props(['task'])

<div x-data='taskItem(@json($task))'
     x-show="! isDeleted"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 scale-90"
     x-transition:enter-end="opacity-100 scale-100"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100 scale-100"
     x-transition:leave-end="opacity-0 scale-90"
     class=" bg-secondary py-2 rounded-lg shadow">

    <div class="flex items-center gap-x-10 justify-between h-10 px-5 border-l-4 border-accent">
        <input class="bg-secondary w-full p-1 rounded-lg outline-2 focus:outline focus:outline-secondary-fonce"
               :class="task.complete ? 'text-extra-muted' : 'text-muted'"
               type="text"
               x-model="task.body"
               name="body"
               @change="update($event)"
        />

        <div class="flex items-center gap-x-3 ">

            <img class="transition duration-300 w-5 h-5 cursor-pointer hover:scale-110"
                 @click='deleteTask()'
                 src="{{ asset('images/trash-icon.png') }}"
                 alt="Trash Icon">

            <input class="cursor-pointer size-5"
                   type="checkbox"
                   :checked="task.complete"
                   @change="complete">
        </div>

    </div>
</div>