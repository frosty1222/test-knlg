<?php

namespace App\Livewire;

use App\Models\Product as ModelsProduct;
use Livewire\Component;

class Product extends Component
{
    public $title = "Product List";
    public $product;
    public $productIds = [];
    public $pageInput;
    protected $listeners = ['deleteProduct'=>'deleteRecord'];
    public function __construct()
    {
        $this->product = new ModelsProduct();
    }
    public function gotopage(){

    }
    public function upPage($value)
    {
        $this->redirect('/product' . '?page=' . $value);
    }

    public function collectId($id){
       if(!in_array($id,$this->productIds)){
            array_push($this->productIds,$id);
       }else{
         $this->productIds = array_diff($this->productIds, [$id]);
       }
    }
    public function deleteRecord(){
        if (count($this->productIds) === 0) {
            session()->flash('message', 'Please select at least one product ID!');
            session()->flash('alert-type', 'warning');
            $this->productIds = [];
            return;
        }
        $delete = $this->product->deleteRecord($this->productIds);
        if($delete === true){
            session()->flash('message', 'Products deleted successfully!');
            session()->flash('alert-type', 'success');
            $this->productIds = [];
            return;
        }
        session()->flash('message', 'Failed to delete products');
        session()->flash('alert-type', 'warning');
    }
    public function render()
    {
        $products = $this->product->getAll();
        return view('livewire.product',[
            'products'=>$products
        ]);
    }
}
