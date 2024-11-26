<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EmployeeCard extends Component
{
    public $workerRole;
    public $profileImage;
    public $name;
    public $jobRole;
    public $position;
    public $email;

    public function __construct($role = null, $profileImage = null, $name = null, $jobRole = null, $position = null, $email = null)
    {
        $this->workerRole = $this->mapRole($role); // Convert numeric role to string
        $this->profileImage = $profileImage ?? 'https://bootdey.com/img/Content/avatar/avatar1.png';
        $this->name = $name;
        $this->jobRole = $jobRole;
        $this->position = $position;
        $this->email = $email;
    }

    /**
     * Map numeric role to string representation.
     */
    private function mapRole($role)
    {
        return match ((int) $role) {
            0 => 'Super Admin',
            1 => 'Admin',
            2 => 'Employee',
            default => 'Unknown Role',
        };
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.employee-card');
    }
}
