@props(['project'])

<div class=" flex flex-col bg-secondary rounded-lg shadow-lg pt-5 min-h-60 max-w-[70rem] text-normal">

    <a class="flex items-center p-2 border-l-4 h-[4rem] border-accent font-semibold text-xl text-muted"
       href="{{ $project->path() }}"
    >
        {{ Str::limit($project->title, 50) }}
    </a>

    <div class="flex flex-col justify-between h-full mb-4">
        <p class="break-words p-4 text-muted">
            {{ Str::limit($project->description) }}
        </p>

        @can('delete', $project)
            @if(Route::currentRouteName() !== 'projects.index')
                <form class="self-end mr-4" action="{{ route('projects.destroy', $project->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button
                            class="transition duration-300 text-normal text-sm py-2 px-3 rounded-md hover:bg-error hover:text-inverse"
                    >
                        Delete
                    </button>
                </form>
            @endif
        @endcan
    </div>
</div>