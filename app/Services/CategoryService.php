<?php

namespace App\Services;

use App\Models\Category as CategoryModel;

class CategoryService
{
    public $categoryModel;
    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }
    public function getAllCategory($request=null){
        $search = null;
        if($request !== null && $request->filled('search')){
             $search = $request->search;
        }
        return $this->categoryModel->getAll($search);
    }
    public function createNewCategory($request){
       
    }
    public function editCategory($request){
       
    }
    public function deleteCategory($request){
       if(!$request->id){
         return false;
       }
       return $this->categoryModel->deleteRecord($request->id);
    }
}
