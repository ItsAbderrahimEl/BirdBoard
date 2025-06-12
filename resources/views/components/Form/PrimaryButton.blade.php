<button {{ $attributes->merge(['class' => 'bg-third p-3 rounded-md text-white font-bold transition-colors duration-300 hover:bg-third-fonce ']) }}>
    {{ $slot }}
</button>