<div class="drawer w-0 md:w-64 md:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle"/>
    <div class="">

    </div>
    <div class="z-40 drawer-side">
        <label for="my-drawer" class="drawer-overlay"></label>

        <div
            class="menu overflow-clip p-4 bg-custom-black  w-64 h-full text-base-content gap-3 flex flex-col justify-start items-start">

            <div class="flex items-center mb-4 justify-between w-full">
                <div class="flex items-center font-semibold gap-2">
                    <x-application-logo class="w-5 h-5 fill-current text-orange-500"/>
                    CLINE
                </div>
            </div>

            <span
                class="ring-1 mb-10 rounded-[8px] w-full flex items-center justify-between normal-case bg-opacity-25 bg-gray-600 p-2 hover:scale-105 transition duration-300">
                    <span class="flex items-center m-0 gap-2">
                        <span class="btn btn-sm btn-circle btn-ghost ring-c rounded-md">

                                        <svg height="18" viewBox="0 0 1024 1089.841" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                fill="white"
                                                fill-opacity="60%"
                                                d="M520.258 1056.92H503.76c0-134.61-50.306-252.21-150.918-352.824S134.628 553.178 0 553.178V536.68c134.628 0 252.23-50.306 352.842-151.145C453.454 284.677 503.76 167.075 503.76 32.938h16.498c0 134.61 50.306 252.21 150.918 352.824S889.39 536.68 1024 536.68v16.498c-134.61 0-252.21 50.306-352.824 150.918S520.258 922.31 520.258 1056.92z"
                                                stroke="#000"
                                                stroke-width="2"
                                                stroke-linejoin="miter"
                                            />
                                        </svg>

                                    </span>
                    <span class="flex h-1/6 max-h-9 overflow-hidden items-start flex-col">
                        <span>
                            Create
                        </span>
                        <span class="text-xs font-normal">
                            New Project
                        </span>
                    </span>
                    </span>
                <i class="fa-solid max-h-9 fa-chevron-down"></i>
            </span>

            <!-- Sidebar content here -->
            <a class="side {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="fa-solid text-green-500 fa-feather"></i>
                <div class="">
                    Dashboard
                </div>
            </a>

            <a href="" class="side {{ request()->routeIs('courses') ? 'active' : '' }}">
                <i class="fa-regular text-blue-600 fa-envelope"></i>
                <div class="">
                    Inbox
                </div>
            </a>

            <a href="" class="side {{ request()->routeIs('courses') ? 'active' : '' }}">
                <i class="ri-pie-chart-line text-yellow-300"></i>
                <div class="">
                    Projects
                </div>
            </a>

            <a href="" class="side {{ request()->routeIs('courses') ? 'active' : '' }}">
                <i class="fa-regular fa-calendar"></i>
                <div class="">
                    Calendar
                </div>
            </a>

            <a class="side" href="">
                <i class="fa-solid text-yellow-200 fa-bolt"></i>
                <div class="">
                    Skills
                </div>
            </a>

            <a href="" class="side {{ request()->routeIs('connect') ? 'active' : '' }}">
                <i class="fa-solid text-pink-400 fa-circle-nodes"></i>
                <div class="">
                    Connect
                </div>
            </a>

            <a href="{{ route('profile.edit') }}" class="side {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                <i class="fa-regular text-orange-500 fa-circle-user"></i>
                <div class="">
                    Account
                </div>
            </a>

        </div>
    </div>
</div>
