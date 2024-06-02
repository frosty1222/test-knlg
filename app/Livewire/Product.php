<?php

namespace App\Livewire;

use App\Models\Category as ModelsCategory;
use App\Models\Product as ModelsProduct;
use Livewire\Component;

class Product extends Component
{
    public $category;
    public $title = "Product List";
    public $product;
    public $productIds = [];
    public $pageInput;
    public $formTitle = 'Add new Product';
    public $isShowModal = false;
    public $alertMess = "";
    protected $listeners = ['deleteProduct'=>'deleteRecord'];
    public $isEdit = false;
    /// model properties
    public $name;
    public $discount_price;
    public $actual_price;
    public $category_id;
    public $productId;
    protected $rules = [
        'name' => 'required|string|min:3',
        'discount_price' => 'required|string',
        'actual_price' => 'required|string',
        'category_id' => 'required',
    ];

    public function __construct()
    {
        $this->product = new ModelsProduct();
        $this->category = new ModelsCategory();
    }
    protected $messages = [
        'name.required' => 'The product name cannot be empty.',
        'discount_price.required' => 'The product discount price cannot be empty.',
        'actual_price.required' => 'The product actual price cannot be empty.',
        'category_id.required' => 'The product category ID cannot be empty.',
    ];
 
    protected $validationAttributes = [
        'name' => 'Product name',
        'discount_price' => 'Product discount price',
        'actual_price' => 'Product actual price',
        'category_id' => 'Product category ID',
    ];
 
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
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
            $this->reset(['productIds']);
            return;
        }
        $delete = $this->product->deleteRecord($this->productIds);
        if($delete === true){
            session()->flash('message', 'Products deleted successfully!');
            session()->flash('alert-type', 'success');
            $this->reset(['productIds']);
            return;
        }
        session()->flash('message', 'Failed to delete products');
        session()->flash('alert-type', 'warning');
        $this->reset(['productIds']);
        return;
    }
    public function showModal($status){
      $this->isShowModal = $status;
      $this->reset(['name','discount_price','actual_price','category_id']);
    }
    public function onSubmit(){
        $validatedData = $this->validate();
        if(!is_array($validatedData) && count($validatedData) === 0){
            session()->flash('message', 'Failed to add categories. Name can not be empty');
            session()->flash('alert-type', 'warning');
            return;
        }
        $action = false;
        if($this->isEdit === false){
            $action = $this->product->create($validatedData);
        }else{
            $findProduct = $this->product::where('id',$this->productId)->first();
            $action =$findProduct->editRecord($validatedData);
        }
        if($action === true){
            $this->reset(['name','discount_price','actual_price','category_id']);
            $this->isShowModal = false;
            session()->flash('message', $this->isEdit === false ? 'product added successfully!':'product edited successfully!');
            session()->flash('alert-type', 'success');
            $this->isEdit = false;
            $this->redirect('/product');
        }else{
            session()->flash('message', 'Failed to add categories');
            session()->flash('alert-type', 'warning');
            $this->isEdit = false;
        }
        
    }
    public function checkName(){
        if($this->isEdit === false){
            $check = $this->product->checkName($this->name);
            if($check === true){
            $this->alertMess = "This product has existed. please pick another one .";
            }else{
            $this->alertMess = "";
            }
        }else{
            $this->alertMess = "";
        }
   }
   public function editAction($data){
        if($data && count($data) === 0) return;
        if(!$data['id']){
           return;
        }
        $this->productId = (int)$data['id'];
        $this->name = $data['name'];
        $this->discount_price = $data['discount_price'];
        $this->actual_price = $data['actual_price'];
        $this->category_id = $data['category_id'];
        $this->isShowModal = true;
        $this->isEdit = true;
        $this->formTitle = 'Edit Product';
    }
    public function render()
    {
        $products = $this->product->getAll();
        $category = $this->category->getAll();
        return view('livewire.product',[
            'products'=>$products,
            'categories'=>$category
        ]);
    }
}
