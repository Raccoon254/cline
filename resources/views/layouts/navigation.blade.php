<div class="nav custom-nav-style relative min-h-14 w-full border-b border-gray-100 text-gray-800 bg-gray-100 bg-opacity-25 backdrop-blur-[1px]">
    <div class="container px-4 flex w-full justify-between items-center">
        <div class="logo mx-2 flex items-center absolute top-2 left-1 text-3xl">
            <a href="{{ url('/') }}" class="flex items-center">
                <i class="fa-solid fa-feather"></i>
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
            <!-- Authentication Links -->
            @if (Route::has('login'))
                <div class="md:p-1 mt-4 md:mt-0 text-left z-10">
                    @auth
                        <div class="center gap-2">
                            <a href="{{ url('/notifications') }}">
                                <button class="btn btn-ghost btn-circle btn-sm ring-c ring-inset ring-gray-400  btn-secondary text-gray-900 scale normal-case">
                                    <i class="fa-solid fa-bell"></i>
                                </button>
                            </a>
                            <a href="{{ url('/messages') }}">
                                <button class="btn btn-ghost btn-circle btn-sm ring-c ring-inset ring-gray-400  btn-secondary text-gray-900 scale normal-case">
                                    <i class="fa-solid fa-envelope"></i>
                                </button>
                            </a>
                            <div class="dropdown backdrop-blur-md dropdown-end">
                                <div tabindex="0" role="button" class="holder pr-2 flex rounded-full ring-1 items-center justify-center gap-1 cursor-pointer hover:bg-gray-100 hover:ring-orange-500 ring-opacity-50 scale">
                                    <div class="btn btn-ghost btn-sm btn-circle avatar">
                                        <div class="w-10 rounded-full">
                                            <img alt="Tailwind CSS Navbar component" src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                        </div>
                                    </div>
                                    <div class="text-sm">
                                        {{ Auth::user()->name }}
                                    </div>
                                    <div class="text-sm">
                                        <i class="fa-solid fa-caret-down"></i>
                                    </div>
                                </div>

                                <ul tabindex="0" class="menu menu-sm dropdown-content bg-gray-50 mt-3 z-[1] p-2 shadow backdrop-blur-md rounded-md w-50">
                                    <li>
                                        <a class="justify-between">
                                            Profile
                                            <span class="badge">New</span>
                                        </a>
                                    </li>
                                    <li><a>Settings</a></li>
                                    <li><a>Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    @else
                        <div class="flex flex-col md:flex-row gap-4">
                            <a href="{{ route('login') }}">
                                <button class="btn btn-outline btn-sm rounded-md ring-1 ring-inset ring-gray-50  btn-secondary text-gray-900 normal-case">
                                    Login
                                </button>
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">
                                    <button class="btn btn-outline btn-sm rounded-md ring-1 ring-inset ring-gray-100 btn-ghost text-gray-900 normal-case">
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
