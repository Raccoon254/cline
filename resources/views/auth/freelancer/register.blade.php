<x-guest-layout>

    <form class="w-full md:w-[70%] items-center justify-center" method="POST" action="{{ route('register') }}">
        @csrf


        <div class="mb-4 mx-2 text-2xl font-semibold text-gray-200">
            {{ __('Welcome to Cline') }}
            <span class="text-sm text-gray-400 font-normal block">
                Let's get you started as a freelancer
            </span>
            <span class="text-sm text-gray-400 font-normal block">
                <a href="{{ route('register') }}"
                    class="underline text-blue-400 hover:text-orange-400">
                    Register as a client <i class="fa-solid fa-arrow-right"></i>
                </a>
            </span>
        </div>

        <div class="flex-col flex md:flex-row mt-4 gap-3">
            <!-- Name -->
            <div>
                <x-text-input  id="name" class="block mt-1 custom-input w-full custom-input" type="text" name="name" :value="old('name')" required placeholder="Name e.g. John Doe"
                              autofocus autocomplete="name"/>
            </div>

            <!-- Email Address -->
            <div>
                <x-text-input id="email" class="block mt-1 custom-input w-full" type="email" name="email" :value="old('email')" required placeholder="Email e.g. m@cline.me"
                              autocomplete="username"/>
            </div>

            <!-- Phone Number -->
            <div>
                <x-text-input id="phone_number" class="block mt-1 custom-input w-full" type="text" name="phone_number" placeholder="Phone e.g. 08012345678" :value="old('phone_number')" required autocomplete="phone_number"/>
            </div>
        </div>

        <div class="flex-col flex md:flex-row gap-4">
            <!-- Password -->
            <div class="mt-4">

                <x-text-input id="password" class="block mt-1 custom-input w-full"
                              type="password"
                              name="password"
                              placeholder="Password e.g. px23ord"
                              required autocomplete="new-password"/>

            </div>

            <!-- Confirm Password -->
            <div class="md:mt-4">

                <x-text-input id="password_confirmation" class="block mt-1 custom-input w-full"
                              type="password"
                              placeholder="Confirm Password e.g. px23ord"
                              name="password_confirmation" required autocomplete="new-password"/>

            </div>
        </div>

        <div class="flex flex-col mt-4">

            <button class="btn ring-1 ring-offset-1 ring-gray-400 btn-secondary normal-case w-full md:w-44 mt-4 rounded-full btn-outline transition duration-300 ease-in-out" type="submit">
                Register
                <i class="fa-solid fa-arrow-right"></i>
            </button>

            <a class="underline text-sm mt-6 text-orange-400 hover:text-blue-400"
               href="{{ route('login') }}">
                Already registered?
            </a>
        </div>
    </form>
</x-guest-layout>
