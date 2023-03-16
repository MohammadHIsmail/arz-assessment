<?php

namespace App\Http\Livewire\DepManagement;

use Livewire\Component;
use App\Models\Department;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DepEdit extends Component
{
    use AuthorizesRequests;

    public $department;
    public $name;

    public function mount($id) { 

        $this->authorize('department-edit');

        $this->department= Department::find($id);

        $this->name= $this->department->name;
        
    }

    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required|unique:departments',
        ]);

        $this->department->name = $validatedData['name'];
        $this->department->save();
    
        return redirect()->route('departments')
            ->with('success', 'Department updated successfully.');
    }

    public function render()
    {
        return view('livewire.dep-management.dep-edit');
    }
}
