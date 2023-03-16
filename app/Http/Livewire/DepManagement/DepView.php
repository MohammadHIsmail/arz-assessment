<?php

namespace App\Http\Livewire\DepManagement;

use Livewire\Component;
use App\Models\Department;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DepView extends Component
{
    use AuthorizesRequests;

    public $departments;

    protected $listeners = [
        'destroy',
    ];

    public function mount() 
    { 
        $this->authorize('department-list');

        $this->departments = Department::orderBy('id', 'desc')->get();
    }

    public function destroy($id)
    {
        Department::where('id', $id)->delete();

        return redirect()->route('departments')
            ->with('success', 'Department deleted successfully');
    }

    public function render()
    {
        return view('livewire.dep-management.dep-view');
    }
}
