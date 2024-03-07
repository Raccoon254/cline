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
            <div class="avatar">
                <div class="w-8 rounded-full ring-1">
                    <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                </div>
            </div>
        </div>
    </div>
</div>
