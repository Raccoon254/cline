<div class="nav relative min-h-14 text-white border-b border-gray-100 bg-gray-100 bg-opacity-10 backdrop-blur-[1px]">
    <div class="px-4 w-full flex justify-between items-center">
        <div class="logo mx-2 flex items-center text-3xl">
            <a href="{{ url('/') }}" class="flex items-center">
                <i class="fa-solid fa-feather mr-2"></i>
                Cline
            </a>
        </div>
        <div class="h-full min-h-12 my-1"></div>
        <!-- Three Dots Icon for small screens -->
        <div class="md:hidden absolute top-3 right-1 flex items-center">
            <button id="menu-btn" class="mobile-menu-button">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="5" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="12" cy="19" r="2"/></svg>
            </button>
        </div>
        <!-- Menu -->
        <div id="menu" class="hidden md:flex flex-col md:flex-row items-start md:items-center my-2 gap-3 text-md">
            <ul class="flex flex-col md:flex-row gap-4">
                <li>
                    <a href="{{ url('/about') }}" class="text-white hover:text-gray-700">
                        Features
                    </a>
                </li>
                <li>
                    <a href="{{ url('/services') }}" class="text-white hover:text-gray-700">
                        Pricing
                    </a>
                </li>
                <li>
                    <a href="{{ url('/contact') }}" class="text-white hover:text-gray-700">
                        Contact
                    </a>
                </li>
            </ul>
            <!-- Authentication Links -->
            @if (Route::has('login'))
                <div class="md:p-1 mt-4 md:mt-0 text-left z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}">
                            <button class="btn btn-outline btn-sm rounded-md ring-1 ring-inset ring-gray-400  btn-secondary text-white normal-case">
                                Dashboard
                            </button>
                        </a>
                    @else
                        <div class="flex flex-col md:flex-row gap-4">
                            <a href="{{ route('login') }}">
                                <button class="btn btn-outline btn-sm rounded-md ring-1 ring-inset ring-gray-50  btn-secondary text-white normal-case">
                                    Login
                                </button>
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">
                                    <button class="btn btn-outline btn-sm rounded-md ring-1 ring-inset ring-gray-100 btn-ghost text-white normal-case">
                                        Register
                                    </button>
                                </a>
                            @endif
                        </div>
                    @endauth
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    // Mobile menu button script
    document.getElementById('menu-btn').addEventListener('click', function() {
        let menu = document.getElementById('menu');
        menu.classList.toggle('hidden');
    });
</script>
