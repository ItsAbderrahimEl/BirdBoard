<x-layout.layout title="Project">
    <div class="mainSection">
        <div class="m-5 md:m-9 lg:m-16 space-y-10 w-full">
            <div class="flex flex-col items-start gap-y-5 md:flex-row  md:items-center md:justify-between">
                <h1 class="text-xl text-muted">
                    <a class="hover:underline" href="{{ route('projects.index') }}">
                        My Projects
                    </a>
                    /{{ $project->title }}
                </h1>

                <div class="flex items-center gap-x-5">
                    <x-projects.members :project="$project" />
                    <x-projects.editProject :project="$project" />
                    <x-projects.InviteUser :project="$project" />
                </div>
            </div>

            <div class="flex flex-col xs:flex-row  gap-5 pr-10 md:p-0 ">
                <div class="flex flex-col flex-1 gap-y-5">
                    <x-projects.tasks :project="$project" />

                    <x-projects.notes :project="$project" />
                </div>

                <div class="xs:w-1/3 flex flex-col gap-y-5">
                    <x-projects.card :project="$project" />
                </div>
            </div>
        </div>

        <x-projects.updates :activities="$project->recentActivities()" />
    </div>
</x-layout.layout>