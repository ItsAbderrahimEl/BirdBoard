@props(['name'])

@error($name)
<div class="text-error -mt-2"> {{ $message }} </div>
@enderror