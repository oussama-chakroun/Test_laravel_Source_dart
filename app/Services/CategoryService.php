<?php 

namespace App\Services ;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\CategoryRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{


    /**
     * CategoryService constructor.
     */
    public function __construct(protected CategoryRepository $categoryRepository)
    {
    }
    
    /**
     * get Categories with condition if with pagination or not.
     */
    public function getCategories(bool $paginate = false) : LengthAwarePaginator|Collection|array
    {
        if ($paginate){
            return $this->categoryRepository->getWithPaginate(10) ;
        }
        else{
            return $this->categoryRepository->getAll() ;
        }

    }

    /**
     * get Category by id.
     */
    public function getCategoryById(int $id) : Category
    {
        return $this->categoryRepository->getCategoryById($id);
    }

    /**
     * store Category .
     */
    public function storeCategory(array $data) : void
    {
        $this->categoryRepository->storeCategory($data);
    }

    /**
     * update Category .
     */
    public function updateCategory(array $new_data , Category $category) : void
    {
        $this->categoryRepository->updateCategory($new_data , $category);
    }

    /**
     * delete Category .
     */
    public function deleteCategory(Category $category) : void
    {
        $this->categoryRepository->deleteCategory($category);
    }

    /**
     * attch product to category
     */
    public function attch_product_to_category(int $product_id,int $category_id) : array
    {
        return $this->categoryRepository->attch_product_to_category($product_id , $category_id);

    }

    /**
     * detach product from category .
     */
    public function detach_product_from_category(int $product_id,int $category_id) : void
    {
        $this->categoryRepository->detach_product_from_category($product_id , $category_id);
    }
}
