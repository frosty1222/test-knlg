<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['name','discount_price','actual_price','category_id'];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function getAll($search = null){
        $data = [];
        if($search === null){
          $data = $this->orderBy('id','DESC')->paginate(10);
        }else{
          $data = $this->where('name', 'like', "%{$search}%")->orderBy('id', 'DESC')->paginate(10);
        }
        foreach($data as $d){
          $d->category;
        }
        return $data;
    }
    public function create($request){
       try {
         $this->name = $request->name;
         $this->discount_price = $request->discount_price;
         $this->actual_price = $request->actual_price;
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
          $this->discount_price = $request->discount_price;
          $this->actual_price = $request->actual_price;
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
            if (count($ids) > 0) {
                $delete = $this->whereIn('id', $ids)->delete();
                return (bool) $delete;
            }
            return false;
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return false;
        }
    }
}
