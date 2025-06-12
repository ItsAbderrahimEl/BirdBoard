@props(['activities'])

<div class="md:w-[30%] p-5 text-sm">
    <h1 class="text-muted text-xl mb-5">Updates</h1>
    <div class="divide-y-2 divide-secondary-fonce">
        @foreach($activities as $activity)
            <div class="flex flex-row items-start text-muted justify-between p-1">
                @include("Projects.activity.{$activity->body}")
                <div class="text-extra-muted text-nowrap">
                    {{ $activity->created_at->diffForHumans(NULL, true) }}
                </div>
            </div>
        @endforeach
    </div>
</div>