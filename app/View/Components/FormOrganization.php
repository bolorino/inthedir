<?php

namespace App\View\Components;

use App\Models\Organization;
use Illuminate\View\Component;
use Route;

class FormOrganization extends Component
{
    /**
     * @var string
     */
    public string $action;

    /**
     * @var array
     */
    public array $provinces;

    /**
     * @var Organization
     */
    public Organization $organization;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( string $action, array $provinces, Organization $organization)
    {
        $this->action = $action;
        $this->provinces = $provinces;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.backend.form-organization');
    }
}
