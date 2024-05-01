<div class="flex flex-col items-center justify-center">
    <h1 class="text-2xl font-bold mb-4">Complete Your Profile</h1>
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 w-full" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="w-full max-w-lg">
        <div class="mb-4 w-full">
            <label for="skills" class="block text-gray-700 font-bold mb-2">Skills</label>
            <select wire:model="skills" id="skills" class="custom-input-profile" multiple>
                @foreach($all_skills as $skill)
                    <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                @endforeach
            </select>
            @error('skills') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4 w-full">
            <label for="certifications" class="block text-gray-700 font-bold mb-2">Certifications</label>
            <textarea wire:model="certifications" id="certifications" class="custom-input-profile"></textarea>
            @error('certifications') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4 w-full">
            <label for="profile_picture" class="block text-gray-700 font-bold mb-2">Profile Picture</label>
            <input type="file" wire:model="profile_picture" id="profile_picture" class="custom-file-input">
            @error('profile_picture') <span class="text-red-500">{{ $message }}</span> @enderror
            <div wire:loading wire:target="profile_picture" class="mt-2">
                Loading...
            </div>
        </div>

        <div class="mb-4 w-full">
            <label for="certification_name" class="block text-gray-700 font-bold mb-2">Certification Name</label>
            <input type="text" wire:model="certification_name" id="certification_name" class="custom-input-profile">
            @error('certification_name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4 w-full">
            <label for="certification_issuer" class="block text-gray-700 font-bold mb-2">Certification Issuer</label>
            <input type="text" wire:model="certification_issuer" id="certification_issuer" class="custom-input-profile">
            @error('certification_issuer') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4 w-full">
            <label for="certification_issue_date" class="block text-gray-700 font-bold mb-2">Certification Issue Date</label>
            <input type="date" wire:model="certification_issue_date" id="certification_issue_date" class="custom-input-profile">
            @error('certification_issue_date') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4 w-full">
            <label for="certification_expiry_date" class="block text-gray-700 font-bold mb-2">Certification Expiry Date</label>
            <input type="date" wire:model="certification_expiry_date" id="certification_expiry_date" class="custom-input-profile">
            @error('certification_expiry_date') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4 w-full">
            <label for="certification_validity" class="block text-gray-700 font-bold mb-2">Certification Validity</label>
            <input type="text" wire:model="certification_validity" id="certification_validity" class="custom-input-profile">
            @error('certification_validity') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4 w-full">
            <label for="certification_document" class="block text-gray-700 font-bold mb-2">Certification Document</label>
            <input type="file" wire:model="certification_document" id="certification_document" class="custom-file-input">
            @error('certification_document') <span class="text-red-500">{{ $message }}</span> @enderror
            <div wire:loading wire:target="certification_document" class="mt-2">
                Loading...
            </div>
        </div>

        <div class="flex items-center mb-4 w-full justify-between">
            <button type="submit" class="btn w-full rounded-[20px] custom-input text-white btn-warning" wire:loading.attr="disabled">
                <span wire:loading.remove>
                    Save
                </span>
                <span wire:loading>
                    Loading...
                </span>
            </button>
        </div>
    </form>
</div>
