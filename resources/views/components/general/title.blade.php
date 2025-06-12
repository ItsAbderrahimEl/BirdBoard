<div {{ $attributes->merge(['class' => 'mx-auto mb-24 flex flex-col w-fit text-accent']) }}>
    <div class="flex items-center">
        <img class="size-16" src="{{ asset('images/logo.png') }}" alt="">
        <h1 class="inline-block font-bold text-5xl ">
            BirdBoard
        </h1>
    </div>
    <span class="self-end text-2xl font-bold">
        {{ $slot }}
    </span>
</div>