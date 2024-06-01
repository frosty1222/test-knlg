<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['name'];
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
    public function create($request){
       try {
         $this->name = $request->name;
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
    public function edit($request){
        try {
          $this->name = $request->name;
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
    
            if (count($ids) === 1) {
                $deleteProduct = Product::where('category_id', $ids[0])->delete();
                if ($deleteProduct) {
                    $delete = Category::where('id', $ids[0])->delete();
                    if ($delete) {
                        return true;
                    }
                }
                return false;
            }
    
            foreach ($ids as $id) {
                Product::whereIn('category_id', [$id])->delete();
                $delete = Category::where('id', $id)->delete();
                if (!$delete) {
                    return false;
                }
            }
    
            return true;
    
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return false;
        }
    }
    
}
