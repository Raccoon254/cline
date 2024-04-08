<!-- Project creation modal -->
<dialog id="project_creation_modal" class="modal rounded-[10px] text-gray-200">
    <div class="modal-box backdrop-blur-sm">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="font-semibold text-lg">New Project</h3>
        <p>
            Fill in the form below to create a new project {{ $role }}
        </p>
        <form class="flex flex-col">
            <label class="mt-4 mb-2" for="name">
                Name
            </label>
            <input class="input ring-1" id="name" type="text" placeholder="name">

            <label class="mt-4 mb-2" for="description">
                Description
            </label>
            <textarea class="textarea ring-1" id="description" type="text" placeholder="description"></textarea>
            <label class="mt-4 mb-2" for="end_date">
                End Date
            </label>
            <input class="input ring-1" id="end_date" type="date" placeholder="end_date">

            <label class="mt-4 mb-2" for="client">
                Client
            </label>
            <input class="input ring-1" id="client" type="text" placeholder="client_id">

            <label class="mt-4 mb-2" for="freelancer">
                Freelancer
            </label>
            <input class="input ring-1" id="freelancer" type="text" placeholder="freelancer_id">

            <!-- Price -->
            <label class="mt-4 mb-2" for="price">
                Price
            </label>
            <input class="input ring-1" id="price" type="number" placeholder="price">
            <button class="btn btn-info mt-4">Create Project</button>
        </form>
        <p class="py-4 text-xs">Press ESC key or click on ✕ button to close</p>
    </div>
</dialog>
