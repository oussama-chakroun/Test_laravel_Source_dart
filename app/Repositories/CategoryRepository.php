<?php 

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use \Illuminate\Database\Eloquent\Collection ;

class CategoryRepository
{
    /**
     * CategoryRepository constructor.
     *
     */
    public function __construct(protected Category $category)
    {
    }
    
    /**
     * Get all categories.
     *
     */
    public function getAll() : Collection|array
    {
        return $this->category
            ->all();
    }

    /**
     * Get category BY id.
     *
     */
    public function getCategoryById(int $id) : Category
    {
        return $this->category
            ->find($id);
    }

    /**
     * Get paginated categories.
     *
     */
    public function getWithPaginate(int $record_number) : LengthAwarePaginator|array
    {
        return $this->category->paginate($record_number);
    }

    /**
     * Store data categories.
     *
     */
    public function storeCategory(array $data) : void
    {
        $this->category->create($data);
    }

    /**
     * Update data categories.
     *
     */
    public function updateCategory(array $data , Category $category) : void
    {
        $category->update($data);
    }

    /**
     * Delete category.
     *
     */
    public function deleteCategory(Category $category) : void
    {
        $category->delete();
    }

    /**
     * attch product to category
     */
    public function attch_product_to_category(int $product_id,int $category_id) : array
    {
        $category = $this->category->find($category_id);
        // check this product to be added if already exists
        if (!$category->products->contains($product_id)) {
            // and this is how we can attach a product to category
            $category->products()->attach($product_id);
            $result['success'] = 'Product attached to this category with success';
        } else {
            $result['warning'] = 'Product already attached to this category !';
        }
        return $result ;
    }

    /**
     * detach product from category .
     */
    public function detach_product_from_category(int $product_id,int $category_id) : void
    {
        $category = $this->category->find($category_id);
        // and this is how we can detqch a category from product
        $category->products()->detach($product_id);
    }
}

?>