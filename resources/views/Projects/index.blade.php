<x-layout.layout title="Projects">
    <div class="mainSection">
        <div class="w-full m-5 md:m-9 lg:m-16 space-y-10">
            <div class="flex items-center justify-between">
                <h1 class="text-xl text-muted">My Projects</h1>
                <x-projects.addProject />
            </div>
            <div class="grid grid-cols-1 xs:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($projects as $project)
                    <x-projects.card :project="$project" />
                @empty
                    <div class="w-full text-center font-bold text-xl">No projects</div>
                @endforelse
            </div>
        </div>

        <x-projects.updates :activities="auth()->user()->allActivity()" />
    </div>
</x-layout.layout>