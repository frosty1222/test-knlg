<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public $product;
    public function __construct()
    {
        $this->product = new Product();
    }
    
}
