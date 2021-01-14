<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddLabourForNewPicking extends Component
{
    public $labour;

    public function render()
    {
        return view('livewire.add-labour-for-new-picking');
    }
}
