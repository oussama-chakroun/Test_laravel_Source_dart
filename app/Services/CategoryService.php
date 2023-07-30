<?php 

namespace App\Services ;

use App\Models\Category;

class CategoryService
{
    public function getCategories($all = false){

        if($all)

            return Category::all();

        else 

            return Category::paginate(10) ;
    }

    public function createCategory($request){
        $request->validate([
            'name' => 'required' ,
            'parent_category' => 'nullable|exists:App\Models\Category,id'
        ]);

        Category::create($request->all());
    } 

    public function updateCategory($request , $category){
        $request->validate([
            'name' => 'required' ,
            'parent_category' => 'nullable|exists:App\Models\Category,id'
        ]);
       $category->update($request->all());
    }

    public function deleteCategory($category){
        $category->delete();
    }
}
