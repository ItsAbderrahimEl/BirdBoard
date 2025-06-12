@props(['project'])

@can('inviteTo', $project)
    <x-general.modal>
        <x-slot name="trigger">
            <button class="button">
                Invite to Project
            </button>
        </x-slot>
        <x-slot name="title">
            Invite to Project
        </x-slot>
        <x-slot name="content">
            <div x-data='inviteUser(@json($project))'
                 class="flex flex-col gap-y-3  w-full m-auto">
                <input class="px-4 py-2 mt-3 rounded-lg outline outline-1 focus:outline-2 text-normal  outline-extra-muted bg-extra-muted shadow placeholder-muted"
                       type="email"
                       x-model="invitedUser"
                       placeholder="Member's email">
                <span id="invite-errors" class="self-start text-error text-sm"></span>
                <button @click="inviteUser()" class="button px-4 py-2 self-end">Invite</button>
            </div>
        </x-slot>
    </x-general.modal>
@endcan