<div x-data="modal">
    <!-- Slot for Trigger -->
    <div @click="open()">
        {{ $trigger }}
    </div>

    <!-- Modal -->
    <div class="fixed inset-0 z-10 backdrop-blur-sm flex items-center justify-center"
         x-show="isOpen"
         style="display: none"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-90"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="ease-in duration-300"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-90"
    >
        <div {{ $attributes->merge(['class' => 'bg-secondary min-w-96 max-h-[75vh] overflow-y-scroll rounded-lg flex flex-col justify-between shadow-xl']) }}
             @click.outside="close()"
        >
            <div class="border-b border-extra-muted flex justify-between items-center p-5">
                <!-- Slot for Title -->
                <h1 class="text-2xl font-bold text-muted">
                    {{ $title }}
                </h1>
                <!-- Close Button -->
                <button @click="close()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-normal" viewBox="0 0 24 24"
                         stroke-width="2"
                         stroke="currentColor"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Slot for Content -->
            <div class="p-5">
                {{ $content }}
            </div>
        </div>
    </div>
</div>