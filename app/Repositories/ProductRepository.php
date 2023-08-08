<?php 

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use App\Services\CategoryService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use \Illuminate\Database\Eloquent\Collection ;

class ProductRepository
{
    /**
     * ProductRepository constructor.
     *
     */
    public function __construct(protected Product $product ,protected CategoryService $categoryService)
    {
    }
    
    /**
     * Get all products.
     *
     */
    public function getAll() : Collection|array
    {
        return $this->product
            ->all();
    }

    /**
     * Get product BY id.
     *
     */
    public function getProductById(int $id) : Product
    {
        return $this->product
            ->find($id);
    }

    /**
     * Get paginated products.
     *
     */
    public function getWithPaginate(int $record_number) : LengthAwarePaginator
    {
        return $this->product->paginate($record_number);
    }

    /**
     * Get all products with order by specific columns.
     *
     */
    public function getOrderBy(string $columns) : LengthAwarePaginator
    {
        return $this->product
            ->OrderBy($columns)->paginate(10);
    }

    /**
     * Get all products with order by anme and price.
     *
     */
    public function getOrderByNameAndPrice(array $parameters) : LengthAwarePaginator
    {
        return $this->product
            ->OrderBy($parameters[0])->OrderBy($parameters[1])->paginate(10);
    }

    /**
     * Get all products belongs to a specific category.
     *
     */
    public function getGroupByCategory(int $id) : LengthAwarePaginator
    {
        return $this->categoryService->getCategoryById($id)->products()->paginate(10);
    }

    /**
     * Store data products.
     *
     */
    public function storeProduct(array $data) : Product
    {
        return $this->product->create($data);
    }

    /**
     * Update data products.
     *
     */
    public function updateProduct(array $new_data , Product $product) : void
    {
        $product->update($new_data);
    }

    /**
     * Delete product.
     *
     */
    public function deleteProduct(Product $product) : void
    {
        $product->delete();
    }

    /**
     * attch category to product 
     */
    public function attch_category_to_product(int $product_id,int $category_id) : array
    {
        $product = $this->product->find($product_id);
        // check this product to be added if already exists
        if (!$product->categories->contains($category_id)) {
            // and this is how we can attach a product to category
            $product->categories()->attach($category_id);
            $result['success'] = 'category attached to this Product with success';
        } else {
            $result['warning'] = 'category already attached to this Product !';
        }
        return $result ;
    }

    /**
     * detach category from product.
     */
    public function detach_category_from_product(int $product_id,int $category_id) : void
    {
        $product = $this->product->find($product_id);
        // and this is how we can detqch a category from product
        $product->categories()->detach($category_id);
    }

}