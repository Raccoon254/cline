<div class="bar text-gray-900 bg-white rounded-t-[8px] h-14">
    <div class="flex justify-between items-center h-full px-4">
        <livewire:cline_search />

        <div class="user flex items-center gap-2">
            <i class="fa-regular fa-bell"></i>
            {{ Auth::user()->name }}
            <div class="dropdown group dropdown-bottom dropdown-end">
                <section tabindex="0" role="region" class="avatar animate-scale cursor-pointer">
                    <div class="w-8 p-[1px] animate-scale rounded-full ring-1">
                        <img class="rounded-full w-full h-full object-cover" src="{{ Auth::user()->profile_image }}"
                            alt="avatar" />
                    </div>
                </section>
                <ul tabindex="0"
                    class="p-2 text-gray-200 bg-base-100 z-50 shadow menu dropdown-content rounded-box w-52">
                    <li>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2">
                            <i class="fa-solid fa-user"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="flex items-center gap-2">
                                <i class="fa-solid fa-sign-out"></i>
                                <span>Logout</span>
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
