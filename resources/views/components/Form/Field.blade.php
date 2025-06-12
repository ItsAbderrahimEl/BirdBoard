@props([
    'name',
    'type' => 'text',
    'value' => '',
    'inputStyle' => ''
])
<label {{ $attributes->merge(['class' => 'flex flex-col gap-y-3']) }}>
    <span class="font-bold hover:cursor-pointer w-fit text-normal">{{ $slot }}</span>
    <input
            name="{{ $name }}"
            value="{{ old($name) ?? $value }}"
            type="{{ $type }}"
            class="focus:outline focus:outline-extra-muted p-1.5 rounded {{ $inputStyle }}"
    >
    <x-Form.input-error :name="$name" />
</label>