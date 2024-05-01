<div class="flex flex-col items-center text-gray-700 justify-center">
    <h1 class="text-2xl font-bold my-7">Complete Your Profile</h1>
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 w-full" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="w-full max-w-lg">
        <div class="mb-4 w-full relative">
            <label for="skills" class="block text-gray-700 font-bold mb-2">Skills</label>
            <div class="flex">
                <input type="text" wire:model.live="search" placeholder="Search skills"
                       class="w-full pb-2 rounded-[20px] border-2 border-gray-300 p-[10px] pl-4 ring-1 ring-gray-300 ring-offset-1 transition-all duration-100 ease-in-out focus:border-blue-300 focus:outline-none {{ $search ? 'rounded-t-[20px] rounded-b-[0px]' : '' }}">
            </div>
            @if(!empty($search))
                <div
                    class="absolute bg-white w-full mt-1 rounded-b-[20px] border-2 border-t-0 p-[10px] pl-4 ring-gray-300 ring-offset-1 transition-all duration-300 ease-in-out border-blue-300 outline-1 outline-blue-700 top-16 z-10">
                    @if($searchResults->count() > 0)
                        <div class="">
                            <h3 class="text-gray-700 font-bold mb-2">Search Results</h3>
                            <ul>
                                @foreach($searchResults->take(4) as $skill)
                                    <li class="flex items-center justify-between py-1" wire:key="{{ $skill->id }}">
                                        <span>{{ $skill->name }}</span>
                                        @if(!$skills->contains($skill))
                                            <button wire:click="addSkill({{ $skill->id }})"
                                                    class="btn btn-xs btn-circle btn-warning tooltip"
                                                    data-tip="Add {{ $skill->name }}">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        @else
                                            <div class="flex gap-2">
                                                <span class="btn btn-xs btn-success tooltip" data-tip="Already Added">
                                                    Added
                                                </span>
                                                <button wire:click="removeSkill({{ $skill->id }})"
                                                        class="btn btn-xs btn-circle bg-red-400 btn-ghost text-white tooltip"
                                                        data-tip="Remove {{ $skill->name }}">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <p>No results found.</p>
                        <span class="text-gray-500 text-xs mb-2">
                            Check out the following skills:
                        </span>
                        <ul>
                            <!-- Random 4 skills -->
                            @foreach($all_skills->take(4) as $skill)
                                <li class="flex items-center justify-between py-1" wire:key="{{ $skill->id }}">
                                    <span>{{ $skill->name }}</span>
                                    @if(!$skills->contains($skill))
                                        <button wire:click="addSkill({{ $skill->id }})"
                                                class="btn btn-xs btn-circle btn-warning tooltip"
                                                data-tip="Add {{ $skill->name }}">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    @else
                                        <div class="flex gap-2">
                                                <span class="btn btn-xs btn-success tooltip" data-tip="Already Added">
                                                    Added
                                                </span>
                                            <button wire:click="removeSkill({{ $skill->id }})"
                                                    class="btn btn-xs btn-circle bg-red-400 btn-ghost text-white tooltip"
                                                    data-tip="Remove {{ $skill->name }}">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @endif
                                </li>
                        @endforeach
                    @endif
                </div>
            @endif
            <div class="mt-4">
                @if($skills->count() > 0)
                    <h3 class="text-gray-700 font-bold mb-2">Selected Skills</h3>
                    <ul>
                        @foreach($skills as $skill)
                            <li class="flex items-center justify-between py-1">
                                <span>{{ $skill->name }}</span>
                                <button wire:click="removeSkill({{ $skill->id }})"
                                        class="btn btn-xs btn-circle bg-red-400 btn-ghost text-white tooltip"
                                        data-tip="Remove {{ $skill->name }}">
                                    <i class="fas fa-times"></i>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No skills added yet.</p>
                @endif
            </div>
            @error('skills') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4 w-full">
            <label for="certifications" class="block text-gray-700 font-bold mb-2">Certifications</label>
            <input wire:model.live="certifications" id="certifications" class="custom-input-profile" />
            @error('certifications') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4 w-full">
            <label for="profile_picture" class="block text-gray-700 font-bold mb-2">Profile Picture</label>
            <input type="file" wire:model.live="profile_picture" id="profile_picture" class="custom-file-input">
            @error('profile_picture') <span class="text-red-500">{{ $message }}</span> @enderror
            <div wire:loading wire:target="profile_picture" class="mt-2">
                Loading...
            </div>
        </div>

        <div class="mb-4 w-full">
            <label for="certification_name" class="block text-gray-700 font-bold mb-2">Certification Name</label>
            <input type="text" wire:model.live="certification_name" id="certification_name" class="custom-input-profile">
            @error('certification_name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4 w-full">
            <label for="certification_issuer" class="block text-gray-700 font-bold mb-2">Certification Issuer</label>
            <input type="text" wire:model.live="certification_issuer" id="certification_issuer" class="custom-input-profile">
            @error('certification_issuer') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4 w-full">
            <label for="certification_issue_date" class="block text-gray-700 font-bold mb-2">Certification Issue
                Date</label>
            <input type="date" wire:model.live="certification_issue_date" id="certification_issue_date"
                   class="custom-input-profile">
            @error('certification_issue_date') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4 w-full">
            <label for="certification_expiry_date" class="block text-gray-700 font-bold mb-2">Certification Expiry
                Date</label>
            <input type="date" wire:model.live="certification_expiry_date" id="certification_expiry_date"
                   class="custom-input-profile">
            @error('certification_expiry_date') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4 w-full">
            <label for="certification_validity" class="block text-gray-700 font-bold mb-2">Certification
                Validity</label>
            <input type="text" wire:model.live="certification_validity" id="certification_validity"
                   class="custom-input-profile">
            @error('certification_validity') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4 w-full">
            <label for="certification_document" class="block text-gray-700 font-bold mb-2">Certification
                Document</label>
            <input type="file" wire:model.live="certification_document" id="certification_document"
                   class="custom-file-input">
            @error('certification_document') <span class="text-red-500">{{ $message }}</span> @enderror
            <div wire:loading wire:target="certification_document" class="mt-2">
                Loading...
            </div>
        </div>

        <div class="flex items-center mb-4 w-full justify-between">
            <button type="submit" class="btn w-full rounded-[20px] custom-input text-white btn-warning"
                    wire:loading.attr="disabled">
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
