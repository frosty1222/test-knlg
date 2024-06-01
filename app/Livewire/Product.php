<?php

namespace App\Livewire;

use App\Services\ProductService;
use Livewire\Component;

class Product extends Component
{
    public $title = "Product List";
    public $productService;
    public function __construct()
    {
        $this->productService = new ProductService();
    }
    public function render()
    {
        return view('livewire.product');
    }
}
