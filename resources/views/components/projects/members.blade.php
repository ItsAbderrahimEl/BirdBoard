@props(['project'])

<div class="flex items-center -space-x-2">
    @foreach($project->members as $member)
        <img x-data='member(@json([ 'projectId' => $project->id, 'memberId' => $member->id]))'
             class="cursor-pointer shadow-lg size-10 rounded-full ring-2 ring-inverse"
             alt="Member"
             @click="deleteMember()"
             src="{{ asset($member->avatar) }}"
             title="Delete member: {{ $member->name }}">
    @endforeach
</div>