<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\ProductService;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * $productService => it's a object instance of class ProductService in folder App\Services\ProductService we declare
     * for use the methods of the ProductService like createProduct , deleteProduct or getProducts inside ProductController;
     */

    private $productService, $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // products to show in view with pagination
        $products = $this->productService->getProducts($request);

        // categories to make a filter by selected category
        $categories = $this->categoryService->getCategories($all = true);
        return view('product.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getCategories();
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->productService->createProduct($request);
        return redirect()->route('product.index')->withSuccess('Product added with success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $categories = $product->categories;
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
    public function update(Request $request, Product $product)
    {
        $this->productService->updateProduct($request, $product);
        return redirect()->route('product.index')->withSuccess('Product updated with success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {

        $this->productService->deleteProduct($product);
        return redirect()->route('product.index')->withSuccess('Product deleted with success');
    }

    // attach a category to a product by this method
    public function attch_category_to_product(Request $request, $product_id)
    {

        if ($request->category) {

            $product = Product::find($product_id);

            // check this category to be added if already exists
            if (!$product->categories->contains($request->category)) {

                // and this is how we can attach a category to product
                $product->categories()->attach($request->category);

                return redirect()->back()->withSuccess('Category attached to this product with success');
            } else {

                return redirect()->back()->with(['warning' => 'Category already attached to this product !']);
            }
        } else {

            return redirect()->back()->withError('please select a category to be attached befor submiting !');
        }
    }

    // detache a category from a product by this method
    public function detach_category_from_product($product_id, $category_id)
    {

        $product = Product::find($product_id);

        // and this is how we can detqch a category from product
        $product->categories()->detach($category_id);

        return redirect()->back()->withSuccess('Category detached from this product with success');
    }
}
