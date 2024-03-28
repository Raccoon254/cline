<div class="bar text-gray-900 bg-white rounded-t-[8px] h-12">
    <div class="flex justify-between items-center h-full px-4">
        <div class="search flex items-center">
            <i class="fas fa-search"></i>
            <label>
                <input type="text" class="input input-sm rounded-none input-ghost text-gray-800 input-no-focus bg-white pl-4" placeholder="Tap here and type..."/>
            </label>
        </div>

        <div class="user flex items-center gap-2">
            <i class="fa-regular fa-bell"></i>
            {{ Auth::user()->name }}
            <a class="avatar" href="{{ route('profile.edit') }}">
                <div class="w-8 p-[1px] rounded-full ring-1">
                    <img
                        class="rounded-full w-full h-full object-cover"
                        src="https://api.dicebear.com/8.x/identicon/svg?seed={{ Auth::user()->name }}"
                        alt="avatar"
                    />
                </div>
            </a>
        </div>
    </div>
</div>
