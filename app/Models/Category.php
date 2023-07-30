<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable = ['name' , 'parent_category'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function parentCategory(){
        return $this->belongsTo(Category::class ,'parent_category');
    }
   
}
