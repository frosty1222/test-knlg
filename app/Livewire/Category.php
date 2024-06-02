<?php

namespace App\Livewire;

use App\Models\Category as ModelsCategory;
use Livewire\Component;

class Category extends Component
{

    public $title = "Category List";
    public $category;
    public $categoryId = [];

    protected $listeners = ['deleteCategory'=>'deleteCategory'];
    public $formTitle = "Add new Category";

    public $isShowSubmitForm = false;
    public $alertMess = "";
    public $isEdit = false;

    public $id= null;
    public $name = "";

    protected $rules = [
        'name' => 'required|string|min:3',
    ];

    public function __construct()
    {
        $this->category = new ModelsCategory();
    }
    protected $messages = [
        'name.required' => 'The category name cannot be empty.'
    ];
 
    protected $validationAttributes = [
        'name' => 'Category name'
    ];
 
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
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
            $this->reset(['categoryId']);
            return;
        }
        $delete = $this->category->deleteRecord($this->categoryId);
        if($delete === true){
            session()->flash('message', 'Category deleted successfully!');
            session()->flash('alert-type', 'success');
            $this->reset(['categoryId']);
            return;
        }
        session()->flash('message', 'Failed to delete categories');
        session()->flash('alert-type', 'warning');
        $this->reset(['categoryId']);
        return;
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
            $action = $this->category->create($this->name);
        }else{
            if($this->id === null || !$this->id){
                return;
            }
            $findCategory = $this->category::find($this->id);
            $action =$findCategory->edit($this->name);
        }
        if($action === true){
            $this->isShowSubmitForm = false;
            session()->flash('message', $this->isEdit === false ?'Category added successfully!':'Category edited successfully!');
            session()->flash('alert-type', 'success');
            $this->isShowSubmitForm = false;
            $this->isEdit = false;
            $this->reset(['name']);
            $this->redirect('/category');
        }else{
            session()->flash('message', 'Failed to add categories');
            session()->flash('alert-type', 'warning');
        }
    }
    public function showModal($status){
        $this->isShowSubmitForm = $status;
        $this->isEdit = false;
    }
    public function checkName(){
         if($this->isEdit === false){
            $check = $this->category->checkName($this->name);
            if($check === true){
                $this->alertMess = "This category has existed. please pick another one";
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
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->isShowSubmitForm = true;
        $this->isEdit = true;
        $this->formTitle = 'Edit Category';
    }
    public function upPage($value)
    {
        $this->redirect('/category' . '?page=' . $value);
    }

    public function render()
    {
        $category = $this->category->getAll();
        return view('livewire.category',[
            'data'=>$category
        ]);
    }
}
