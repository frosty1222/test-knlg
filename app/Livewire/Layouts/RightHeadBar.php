<?php

namespace App\Livewire\Layouts;

use Livewire\Component;

class RightHeadBar extends Component
{
    public $showInfo = false;
    public $count = 1;
    public function showInFo(){
        $this->count++;
        if($this->count % 2 === 0){
           $this->showInfo = true;
        }else{
            $this->showInfo = false;
        }
    }
    public function render()
    {
        return view('livewire.layouts.right-head-bar');
    }
}
