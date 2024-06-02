<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'categories';
    protected $fillable = ['name','id'];
    public function products(){
        return $this->hasMany(Product::class,'category_id','id');
    }
    public function getAll($search = null){
        $data = [];
        if($search === null){
          $data = $this->orderBy('id','DESC')->paginate(10);
        }else{
          $data = $this->where('name', 'like', "%{$search}%")->orderBy('id', 'DESC')->paginate(10);
        }
        return $data;
    }
    public function create($name){
       try {
         $id = $this->latest('id')->first();
         $this->name = $name;
         $this->id = $id->id +1;
         $save = $this->save();
         if($save){
            return true;
         }
         return false;
       } catch (\Throwable $th) {
         Log::error($th->getMessage());
         return false;
       }
    }
    public function checkName($name){
        try {
            $check = $this->where('name',$name)->first();
            if($check){
                return true;
            }
            return false;
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return false;
        }
    }
    public function edit($name){
        try {
          $this->name = $name;
          $edit = $this->save();
          if($edit){
             return true;
          }
          return false;
        } catch (\Throwable $th) {
          Log::error($th->getMessage());
          return false;
        }
    }
    public function deleteRecord(array $ids)
    {
        try {
            if (count($ids) === 0) {
                return false;
            }
    
            foreach ($ids as $id) {
                $productCount = Product::where('category_id', $id)->count();
                
                if ($productCount > 0) {
                    Product::where('category_id', $id)->delete();
                }
                $remainingProductCount = Product::where('category_id', $id)->count();
    
                if ($remainingProductCount === 0) {
                    $delete = Category::where('id', $id)->delete();
                    if (!$delete) {
                        return false;
                    }
                }
            }
    
            return true;
    
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return false;
        }
    }
}
