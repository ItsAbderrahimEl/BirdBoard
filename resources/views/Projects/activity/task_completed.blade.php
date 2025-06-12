<div class="flex flex-nowrap items-center gap-x-2">
    <img class="size-7" src="{{ asset('images/task_completed.png') }}" alt="Icon">
    <div>
        {{ $activity->username() }} completed
        <span class="font-semibold">
            {{ $activity->subject->body }}
        </span>
    </div>
</div>