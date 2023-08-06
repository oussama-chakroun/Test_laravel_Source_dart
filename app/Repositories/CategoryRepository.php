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
     * Delete data categories.
     *
     */
    public function deleteCategory(Category $category) : void
    {
        $category->delete();
    }

}

?>