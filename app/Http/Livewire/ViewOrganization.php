<?php

namespace App\Http\Livewire;

use App\Models\Organization;
use LivewireUI\Modal\ModalComponent;

class ViewOrganization extends ModalComponent
{
    public int|Organization $organization;

    public function mount(Organization $organization)
    {
        $this->organization = $organization;
    }

    public function render()
    {
        return view('livewire.view-organization');
    }
}
