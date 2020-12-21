<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Roles extends Component
{
    public $showUpsertModal = false;
    public $showDeleteModal = false;

    public $title;
    public $description;

    public $roleId;
    public $roleTitle;

    protected $rules = [
        'title' => ['bail', 'required', 'string', 'between:3,32'],
        'description' => ['bail', 'required', 'string'],
    ];

    /**
     * Runs once when the component is mounting
     */
    public function mount()
    {
        
    }

    /**
     * Renders the component
     */
    public function render()
    {
        return view('livewire.roles', ['roles' => $this->read()]);
    }

    /**
     * Read all the roles from the database
     * 
     * @return Collection
     */
    public function read()
    {
        return Role::all();
    }


    /**
     * Acivates updating role status
     */
    public function showEditRoleModal(Role $role)
    {
        $this->roleId = $role->id;
        $this->roleTitle = $this->title = $role->title;
        $this->description = $role->description;

        $this->toggleShowUpsertModal();
    }

    /**
     * Initiates the deleting role status
     */
    public function showConfirmRoleDeletionModal(Role $role)
    {
        $this->roleId = $role->id;
        $this->roleTitle = $role->title;

        $this->showDeleteModal = true;
        
    }

    /**
     * Shows | Hides the insert|updating modal based on whether it is currently visible or not
     */
    public function toggleShowUpsertModal()
    {
        $this->showUpsertModal = !$this->showUpsertModal;
    }

    public function updatedShowUpsertModal($flag)
    {
        if(!$flag){
            $this->reset();
        }
    }

    public function updatedShowDeleteModal($flag)
    {
        if(!$flag){
            $this->reset();
        }
    }

    /**
     * Persist a role to the database based the modelled attributes
     */
    public function createRole()
    {
        $data = $this->validate();

        Role::create($data);

        $this->toggleShowUpsertModal();
    }

    /**
     * Updates a role that already exists
     */
    public function updateRole()
    {
        if(!is_null($this->roleId)){
            
            $data = $this->validate();

            Role::findOrFail($this->roleId)
                ->update($data);

            $this->toggleShowUpsertModal();
        }
    }

    public function deleteRole()
    {
        if(!is_null($this->roleId)){
            Role::destroy($this->roleId);

            $this->showDeleteModal = false;
        }
    }
}
