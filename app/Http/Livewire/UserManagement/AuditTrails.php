<?php

namespace App\Http\Livewire\UserManagement;

use Livewire\Component;
use App\Models\AuditTrail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AuditTrails extends Component
{
    public $auditTrail;
    use AuthorizesRequests;

    public function mount() 
    { 
        $this->authorize('audit-trail');

        $this->auditTrail = AuditTrail::orderBy('id', 'asc')->get();
    }

    public function render()
    {
        return view('livewire.user-management.audit-trail');
    }
}
