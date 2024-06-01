<?php

namespace App\Livewire\Layouts;

use Livewire\Component;

class Leftbar extends Component
{
    public $routes = [
        [
            "path"=>"/dashboard",
            "name"=>"Dashboard",
            "icon"=>"bi bi-speedometer2",
            "children"=>[]
        ],
        [
            "path"=>"/product",
            "name"=>"Product List",
            "icon"=>"bi bi-diagram-2",
            "children"=>[]
        ],
        [
            "path"=>"/category",
            "name"=>"Category List",
            "icon"=>"bi bi-bookmark-check-fill",
            "children"=>[
                // [
                //     'name' => 'Consulting',
                //     'path' => '/services/consulting',
                //     'icon' => 'bi bi-diagram-2',
                // ],
                // [
                //     'name' => 'Support',
                //     'path' => '/services/support',
                //     'icon' => 'bi bi-diagram-2',
                // ],
            ]
        ]
    ];
    public $isShowLeftBar = true;
    public $selectedIndex = null;
    // public function mount()
    // {
    //     $this->isShowLeftBar = true;
    // }
    public function showChildrenRoute($index)
    {
        if ($this->selectedIndex === $index) {
            $this->selectedIndex = null;
        } else {
            $this->selectedIndex = $index;
        }
    }
    public function hideBar(){
        $this->isShowLeftBar = false;
    }
    public function showBar(){
        $this->isShowLeftBar = true;
    }
    public function render()
    {
        return view('livewire.layouts.leftbar');
    }
}
