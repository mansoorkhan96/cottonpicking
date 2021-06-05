<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UpdateIsActive extends Component
{
    public $user;
    public $isActive;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->isActive = $user->is_active;
    }

    public function updatedIsActive($value)
    {
        $this->user->is_active = $value;
        $this->user->save();
    }

    public function render()
    {
        return view('livewire.update-is-active');
    }
}
