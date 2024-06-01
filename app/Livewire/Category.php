<?php

namespace App\Livewire;

use App\Models\Category as ModelsCategory;
use Livewire\Component;

class Category extends Component
{

    public $title = "Category List";
    public $category;
    public $categoryId = [];
    protected $listeners = ['deleteCategory'=>'deleteCategory','categoryDeleted'=>'categoryDeleted'];
    public function __construct()
    {
        $this->category = new ModelsCategory();
    }
    public function collectId($id,$event){
        if ($event === true) {
            if (!in_array($id, $this->categoryId)) {
                array_push($this->categoryId,$id);
            }
        } else {
            $this->categoryId = array_diff($this->categoryId, [$id]);
        }
    }
    public function deleteCategory(){
        if (count($this->categoryId) === 0) {
            session()->flash('message', 'Please select at least one category ID!');
            session()->flash('alert-type', 'warning');
            return;
        }
        $delete = $this->category->deleteRecord($this->categoryId);
        if($delete === true){
            session()->flash('message', 'Category deleted successfully!');
            session()->flash('alert-type', 'success');
            $this->categoryId = [];
            return;
        }else{
            session()->flash('message', 'Failed to delete categories');
            session()->flash('alert-type', 'warning');
        }
    }
    public function render()
    {
        $category = $this->category->getAll();
        return view('livewire.category',[
            'data'=>$category
        ]);
    }
}
