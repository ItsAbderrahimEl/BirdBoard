<div x-data="profile"
     class="relative">

    <img @click="open()"
         class="cursor-pointer w-14 h-16"
         src="{{ asset('storage/avatars/default-avatar.png') }}"
         alt="Avatar">

    <div class="absolute bg-primary w-44 rounded-xl p-2 top-16 right-4 shadow-lg space-y-2"
         style="display: none"
         x-transition
         x-show="isModalOpen"
         @click.outside="close()"
    >
        <form action="{{ route('logout') }}"
              method="POST">
            @csrf
            <button class="block w-full p-2 bg-secondary rounded-lg text-muted text-center">
                Logout
            </button>
        </form>
    </div>
</div>