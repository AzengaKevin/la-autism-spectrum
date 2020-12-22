<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Users extends Component
{
    public $showChangeRoleModal = false;

    public $userId;

    public $userName;

    public $role_id;

    protected $rules = [
        'role_id' => ['bail', 'required', 'numeric']
    ];

    protected $validationAttributes = [
        'role_id' => 'role'
    ];

    public function render()
    {
        return view('livewire.users', [
            'users' => $this->read(),
            'roles' => $this->roles()
        ]);
    }

    /**
     * Reads all the users from the database
     */
    private function read()
    {
        return User::with('role')->get();
    }

    /**
     * Get all the roles from the database
     */
    public function roles()
    {
        return Role::all();
    }

    public function showChangeRoleModal(User $user)
    {
        $this->userId = $user->id;
        $this->userName = $user->name;

        $this->toggleChangeRoleModal();
    }

    public function toggleChangeRoleModal()
    {
        $this->showChangeRoleModal = !$this->showChangeRoleModal;
    }

    public function updatedShowChangeRoleModal($flag)
    {
        if(!$flag) $this->reset();
    }

    public function updateUser()
    {
        Log::info('Called');

        $data = $this->validate();

        info('Validated');

        User::findOrFail($this->userId)->update($data);

        info('Updated');

        $this->toggleChangeRoleModal();

        info('Closed');

    }

}
