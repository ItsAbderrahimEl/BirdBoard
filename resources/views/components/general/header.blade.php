<header class="flex justify-between items-center bg-header p-5">
    <div>
        <a href="{{ route('projects.index') }}">
            <div class="flex items-center gap-x-4">
                <img src="{{ asset('images/logo.png') }}"
                     alt="Logo"
                     class="w-10 h-16">
                <h1 class="text-2xl text-normal">{{ config("app.name") }}</h1>
            </div>
        </a>

    </div>
    <div class="flex items-center gap-x-14 mr-5">
        <div x-data="themeSwitcher" class="flex items-center gap-x-2">
            <div @click="updateTheme('dark-theme')"
                 class="rounded-full size-4 bg-black shadow shadow-normal cursor-pointer"></div>
            <div @click="updateTheme('light-theme')"
                 class="rounded-full size-4 bg-white shadow shadow-normal cursor-pointer"></div>
        </div>
        <x-general.profil />
    </div>
</header>