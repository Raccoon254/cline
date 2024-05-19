<?php

namespace App\Http\Livewire;

use App\Models\Skill;
use App\Models\User;
use App\Models\UserCertification;
use App\Models\UserSkill;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserCompleteProfileForm extends Component
{
    use WithFileUploads;

    public $skills;
    public $all_skills;
    public $search = '';
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
        $this->skills = Auth::user()->skills;
        $this->all_skills = Skill::all();
        //$this->certifications = Auth::user()->certifications;
        $this->profile_picture = Auth::user()->profile_picture;
    }

    public function addSkill($skillId = null): void
    {
        //if the skills are more than 5, return an error message on skills
        if ($this->skills->count() >= 5) {
            session()->flash('message', 'You can only add up to 5 skills.');
            return;
        }
        $skill = $skillId ? Skill::find($skillId) : Skill::where('name', $this->search)->first();

        if ($skill && !$this->skills->contains($skill)) {
            $this->skills->push($skill);
            $this->search = '';
        }
    }

    public function removeSkill($skillId): void
    {
        $skill = Skill::find($skillId);

        if ($skill) {
            $this->skills = $this->skills->reject(function ($value, $key) use ($skill) {
                return $value->id === $skill->id;
            });
        }
    }

    public function getSearchResultsProperty()
    {
        return Skill::where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function submit(): void
    {
        $this->validate([
            'skills' => 'required|array',
            'profile_picture' => 'required|image',
            'certification_name' => 'required',
            'certification_issuer' => 'required',
            'certification_issue_date' => 'required|date',
            'certification_expiry_date' => 'required|date',
            'certification_validity' => 'required',
            'certification_document' => 'required|file',
        ]);

        $user = User::find(Auth::id());
        //save skills dont use sync as it will delete the existing skills use foreach
        foreach ($this->skills as $skill) {
            UserSkill::create([
                'user_id' => $user->id,
                'skill_id' => $skill->id,
                'mastery_level' => 30,
            ]);
        }

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
        $searchResults = Skill::where('name', 'like', '%' . $this->search . '%')->get();
        //Todo Return Suggested Skills

        return view(
            'livewire.user-complete-profile-form',
            compact('searchResults')
        );
    }
}
