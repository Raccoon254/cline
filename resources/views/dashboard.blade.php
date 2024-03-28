<x-app-layout>
    <div class=" text-gray-900 p-4">
        <div class="message flex flex-col">
            <span>
                Hello, {{ Auth::user()->name }}
            </span>
            <span class="text-xs text-gray-700">
                Welcome to your dashboard
            </span>
        </div>
        <!-- Page Modals -->
        <dialog id="project_creation_modal" class="modal text-gray-200">
          <div class="modal-box backdrop-blur-sm">
            <form method="dialog">
              <button class="btn btn-sm ring-1 btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="font-semibold text-lg">New Project</h3>
            <p>
                Create a new project by filling out the form below.
            </p>
            <!--
            protected $fillable = [
                'name',
                'project_id',
                'status', // 'active', 'completed', 'archived', 'pending', 'cancelled', 'in_progress'
                'description',
                'start_date',
                'end_date',
                'user_id',
                'client_id',
            ];
            -->
            <form class="flex flex-col">
                <label for="name">
                    Name
                </label>
                <input class="input ring-1" type="text" placeholder="name">

                <label for="description">
                    Description
                </label>
                <textarea class="textarea ring-1" type="text" placeholder="description"></textarea>
                <label for="end_date">
                    End Date
                </label>
                <input class="input ring-1" type="date" placeholder="end_date">
                <label for="client">
                    Client
                </label>
                <input class="input ring-1" type="text" placeholder="client_id">
            </form>
            <p class="py-4 text-xs">Press ESC key or click on ✕ button to close</p>
          </div>
        </dialog>
        <!-- Page Content -->
        <div class="py-4">

            <div class="grid gap-2 grid-cols-2 w-full sm:w-[310px]">
                <div class="dashboard-card">
                    <div class="top">
                        <div class="badge">
                        <span class="text-xs text-gray-100">
                            +12
                        </span>
                        </div>
                    </div>
                    <div class="mid">
                        <i class="ri-user-star-line"></i>
                    </div>
                    <div class="data flex-col flex items-center justify-center">
                        <div class="text-lg">
                            1,200
                        </div>
                        <div class="text-xs text-gray-700">
                            Users
                        </div>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="top">
                        <div class="badge">
                        <span class="text-xs text-gray-100">
                            +2
                        </span>
                        </div>
                    </div>
                    <div class="mid">
                        <i class="fa-regular fa-clock"></i>
                    </div>
                    <div class="data flex-col flex items-center justify-center">
                        <div class="text-lg">
                            389+
                        </div>
                        <div class="text-xs text-gray-700">
                            Hours Worked
                        </div>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="top">
                        <div class="badge">
                        <span class="text-xs text-gray-100">
                            +12
                        </span>
                        </div>
                    </div>
                    <div class="mid">
                        <i class="ri-user-star-line"></i>
                    </div>
                    <div class="data flex-col flex items-center justify-center">
                        <div class="text-lg">
                            1,200
                        </div>
                        <div class="text-xs text-gray-700">
                            Users
                        </div>
                    </div>
                </div>
            </div>
            <div class="next">
                <div class="label mt-2">
                    <span class="text-gray-700">
                        Clients & Stats <i class="fa-solid fa-chart-simple"></i>
                    </span>
                </div>
            </div>
            <div class="earn-container text-gray-400">
                <div class="earn-card">
                    <span class="text-white text-xl">
                        <i class="fa-solid text-green-500 fa-arrow-trend-up"></i>
                        +12%
                    </span>
                    <div class="">
                            <span class="text-xs">
                               Clicks
                            </span>
                    </div>
                </div>

                <div class="earn-card">
                    <span class="text-white text-xl">
                        <i class="fa-solid text-red-500 fa-arrow-trend-down"></i>
                        -7
                    </span>
                    <div class="">
                            <span class="text-xs">
                               Total Projects
                            </span>
                    </div>
                </div>

                <div class="earn-card">
                    <span class="text-white text-xl">
                        <i class="fa-solid text-green-500 fa-arrow-trend-up"></i>
                        340 $
                    </span>
                    <div class="">
                            <span class="text-xs">
                                 Total Earnings
                            </span>
                    </div>
                </div>

                <div class="earn-card">
                    <span class="text-white text-xl">
                        <i class="fa-solid text-orange-500 fa-arrow-right-long"></i>
                        + 0
                    </span>
                    <div class="">
                            <span class="text-xs">
                               New Clients
                            </span>
                    </div>
                </div>


            </div>

        </div>
    </div>
</x-app-layout>
