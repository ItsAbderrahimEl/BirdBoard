<div class="flex items-center gap-x-2 flex-nowrap">
    <img class="size-7" src="{{ asset('images/project_updated.png') }}" alt="Icon">
    <div>
        {{ $activity->username() }} updated the
        <span class="font-semibold">
            {{ key($activity->changes['after']) }}
        </span>
    </div>
</div>