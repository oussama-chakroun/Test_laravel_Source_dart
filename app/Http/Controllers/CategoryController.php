<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\CategoryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    private $categoryService;
    
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $categories = $this->categoryService->getCategories($paginate=true);
        return view('category.index' , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $categories = $this->categoryService->getCategories($paginate = true);
        return view('category.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request) : RedirectResponse
    {
        // get all inputs except the _token field
        $data = $request->except('_token');
        try {
            $this->categoryService->storeCategory($data);
            return redirect()->route('category.index')->withSuccess('category added with success');
        } catch(\Exception $e){
            return redirect()->route('category.index')->withError($e->getMessage());
        }
        

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category) : View
    {
        $products = $category->products ;
        $items = Product::all();
        return view('category.show' ,  compact('category' ,'products' ,'items'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category) : View
    {
        $parent_categories = $this->categoryService->getCategories();
        return view('category.edit' ,  compact('category' ,'parent_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category) : RedirectResponse
    {
        // get all inputs except the _token field
        $new_data =  $request->except('_token');
        try{
            $this->categoryService->updateCategory($new_data , $category);
            return redirect()->route('category.index')->withSuccess('Category updated with success');
        } catch(\Exception $e){
            return redirect()->route('category.index')->withError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category) : RedirectResponse
    {
        try{

            $this->categoryService->deleteCategory($category);
            return redirect()->route('category.index')->withSuccess('category deleted with success');
        }
        catch(\Exception $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    // attach a product to a caegory by this method
    public function attch_product_to_category(Request $request, $category_id) : RedirectResponse
    {

        if ($request->product) {

            $category = Category::find($category_id);

            // check this product to be added if already exists
            if (!$category->products->contains($request->product)) {

                // and this is how we can attach a product to category
                $category->products()->attach($request->product);

                return redirect()->back()->withSuccess('Product attached to this category with success');
            } else {

                return redirect()->back()->with(['warning' => 'Product already attached to this category !']);
            }
        } else {

            return redirect()->back()->withError('please select a product to be attached before submiting !');
        }
    }

    // detache a product from a category by this method
    public function detach_product_from_category($product_id, $category_id) : RedirectResponse
    {

        $category = Category::find($category_id);

        // and this is how we can detqch a category from product
        $category->products()->detach($product_id);

        return redirect()->back()->withSuccess('Category detached from this product with success');
    }
}
