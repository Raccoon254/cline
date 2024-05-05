<div>
    <input wire:model.live="search" type="text" class="form-control" placeholder="Search users by name...">
    <h1>All Users</h1>
    @foreach($users as $user)
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $user->name }}</h5>
                <p class="card-text">{{ $user->email }}</p>
                <img src="{{ $user->profile_image }}" alt="{{ $user->name }}" class="h-10 w-10 img-thumbnail">
            </div>
        </div>
    @endforeach
    {{ $users->links() }}
</div>
