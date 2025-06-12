<x-layout.layout title="Login" class="bg-primary">
    <div class="flex justify-center items-center h-screen">
        <div class="w-1/3 h-4/5 p-14">
            <form class="flex flex-col  justify-evenly"
                  action="{{ route('login.post') }}"
                  method="POST">
                @csrf
                <x-general.title>
                    Login
                </x-general.title>

                <div class="space-y-3 mb-10">
                    <x-Form.Field input-style="bg-gray-200" name="email"
                                  type="email">
                        Email
                    </x-Form.Field>

                    <x-Form.Field input-style="bg-gray-200" name="password"
                                  type="password">
                        Password
                    </x-Form.Field>

                    <label class="font-bold hover:cursor-pointer w-fit flex items-center gap-x-2 text-normal">
                        Remember
                        <input class="hover:cursor-pointer accent-gray-500"
                               type="checkbox"
                               name="remember">
                    </label>
                </div>
                <x-Form.PrimaryButton class="w-full">
                    Login
                </x-Form.PrimaryButton>
            </form>
            <p class="text-sm text-muted  underline underline-offset-4 decoration-slice decoration-accent mt-10">
                If you are not registered yet, please do it
                <a class="text-accent" href="{{ route('register.get') }}">here</a>
            </p>
        </div>
    </div>
</x-layout.layout>