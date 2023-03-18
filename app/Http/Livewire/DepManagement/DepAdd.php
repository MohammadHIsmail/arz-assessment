<?php

namespace App\Http\Livewire\DepManagement;

use Livewire\Component;
use App\Models\Department;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\AuditService;

class DepAdd extends Component
{
    use AuthorizesRequests;

    public $name;

    public function mount() { 

        $this->authorize('department-add');
        
    }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required|unique:departments',
        ]);

        $newData['name']=$validatedData['name'];

        AuditService::AuditLog([],$newData,auth()->user()->id,'department','add');

        $department = new Department();
        $department->name = $validatedData['name'];
        $department->save();
    
        return redirect()->route('departments')
            ->with('success', 'Department created successfully.');
    }

    public function render()
    {
        return view('livewire.dep-management.dep-add');
    }
}
