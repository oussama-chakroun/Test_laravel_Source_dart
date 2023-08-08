<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * $productService => it's a object instance of class ProductService in folder App\Services\ProductService we declare
     * for use the methods of the ProductService like createProduct , deleteProduct or getProducts inside ProductController;
     */

    public function __construct(protected ProductService $productService,protected CategoryService $categoryService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : view
    {
        $parameters = $request->all();
        // products to show in view with pagination
        $products = $this->productService->getProducts($paginate = true , $parameters);
        // categories to make a filter by selected category
        $categories = $this->categoryService->getCategories();
        return view('product.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : view
    {
        $categories = $this->categoryService->getCategories();
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request) : RedirectResponse
    {
        // get all inputs except the _token field
        $data = $request->except('_token');
        try{
            $this->productService->storeProduct($data);
            return redirect()->route('product.index')->withSuccess('Product added with success');
        } catch(\Exception $e){
            return redirect()->route('product.index')->withError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // categories => it's for the categories belongs to this product
        $categories = $product->categories()->paginate(10);
        // items => it's all categories to be attached to this product ($product)
        $items = $this->categoryService->getCategories();
        return view('product.show', compact('product', 'categories', 'items'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product) : RedirectResponse
    {
        try{
            // get all inputs except the _token field
            $new_data = $request->except('_token');
            $this->productService->updateProduct($new_data, $product);
            return redirect()->route('product.index')->withSuccess('Product updated with success');
        } catch(\Exception $e){
            return redirect()->route('product.index')->withError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product) : RedirectResponse
    {
        try {
            $this->productService->deleteProduct($product);
            return redirect()->route('product.index')->withSuccess('Product deleted with success');
        } catch(\Exception $e){
            return redirect()->route('product.index')->withError($e->getMessage());
        }

    }

    // attach a category to a product by this method
    public function attch_category_to_product(Request $request, $product_id) : RedirectResponse
    {
        // check if the request has a product to be added
        if ($request->category) {
            $result = $this->productService->attch_category_to_product($product_id , $request->category);
        } else {
            $result['error'] = 'please select a category to be attached before submiting !';
        }
        return redirect()->back()->with($result);
    }

    // detache a category from a product by this method
    public function detach_category_from_product($product_id, $category_id) : RedirectResponse
    {
        try {
            $this->productService->detach_category_from_product($product_id, $category_id);
            return redirect()->back()->withSuccess('Category detached from this product with success');
        }
        catch(\Exception $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
