<div class="flex flex-nowrap items-center gap-x-2">
    <img class="size-7" src="{{ asset('images/task_deleted.png') }}" alt="Icon">
    <div>
        {{ $activity->username() }} deleted the
        <span class="font-semibold">
            {{ $activity->changes['before']['body'] }}
        </span>
        task
    </div>
</div>