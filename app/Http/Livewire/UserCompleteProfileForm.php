<?php

namespace App\Http\Livewire;

use App\Models\Skill;
use App\Models\User;
use App\Models\UserCertification;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserCompleteProfileForm extends Component
{
    use WithFileUploads;

    public $skills = [];
    public $all_skills;
    public $certifications;
    public $profile_picture;
    public $certification_name;
    public $certification_issuer;
    public $certification_issue_date;
    public $certification_expiry_date;
    public $certification_validity;
    public $certification_document;

    public function mount(): void
    {
        $this->skills = Auth::user()->skills->pluck('id')->toArray();
        $this->all_skills = Skill::all();
        $this->certifications = Auth::user()->certifications;
        $this->profile_picture = Auth::user()->profile_picture;
    }

    public function submit(): void
    {
        $this->validate([
            'skills' => 'required|array',
            'certifications' => 'required',
            'profile_picture' => 'required|image',
            'certification_name' => 'required',
            'certification_issuer' => 'required',
            'certification_issue_date' => 'required|date',
            'certification_expiry_date' => 'required|date',
            'certification_validity' => 'required',
            'certification_document' => 'required|file',
        ]);

        $user = User::find(Auth::id());
        $user->skills()->sync($this->skills);
        $user->certifications = $this->certifications;

        // Handle profile picture upload
        $profile_picture_path = $this->profile_picture->store('profile_pictures', 'public');
        $user->profile_picture = $profile_picture_path;
        $user->save();

        // Create UserCertification
        $certification_document_path = $this->certification_document->store('certification_documents', 'public');
        UserCertification::create([
            'user_id' => $user->id,
            'name' => $this->certification_name,
            'issuer' => $this->certification_issuer,
            'issue_date' => $this->certification_issue_date,
            'expiry_date' => $this->certification_expiry_date,
            'validity' => $this->certification_validity,
            'document_path' => $certification_document_path,
            'document_name' => $this->certification_document->getClientOriginalName(),
        ]);

        session()->flash('message', 'Profile successfully updated.');
    }

    public function render(): View
    {
        return view('livewire.user-complete-profile-form');
    }
}
