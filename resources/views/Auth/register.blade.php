<x-layout.layout title="Register" class="bg-primary">
    <div class="flex justify-center items-center h-screen">
        <div class="w-2/5 px-16 py-5">
            <form class="flex flex-col  justify-evenly"
                  action="{{ route('register.post') }}"
                  method="POST">
                @csrf
                <x-general.title class="mt-5">
                    Register
                </x-general.title>

                <div class="space-y-2 mb-8">
                    <x-Form.Field input-style="bg-gray-200" name="email"
                                  type="email">
                        Email
                    </x-Form.Field>

                    <x-Form.Field input-style="bg-gray-200" name="name">
                        Name
                    </x-Form.Field>

                    <x-Form.Field input-style="bg-gray-200" name="password"
                                  type="password">
                        Password
                    </x-Form.Field>

                    <x-Form.Field input-style="bg-gray-200" name="password_confirmation"
                                  type="password">
                        Confirm Password
                    </x-Form.Field>
                </div>
                <x-Form.PrimaryButton class="w-full">
                    Register
                </x-Form.PrimaryButton>
            </form>
            <p class="text-sm text-gray-700  underline underline-offset-4 decoration-slice decoration-accent mt-10">
                If you are registered, pleas
                <a class="text-accent" href="{{ route('login.get') }}">login</a>
            </p>
        </div>
    </div>
</x-layout.layout>