<?php 

namespace App\Services ;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    /**
     * CategoryService constructor.
     */
    public function __construct(protected ProductRepository $productRepository)
    {
    }
    
    /**
     * get Product with condition if with pagination or not.
     */
    public function getProducts(bool $paginate = false , array $parameters = []) : LengthAwarePaginator|Collection|array
    {
        // to use oderBy and filter we check the parameters first 
        if(array_key_exists('name',$parameters) &&array_key_exists('price',$parameters)){
            $parameters = array_keys($parameters);
            return $this->productRepository->getOrderByNameAndPrice($parameters);
        }
        elseif(array_key_exists('name',$parameters)){
            return $this->productRepository->getOrderBy('name');
        }
        elseif(array_key_exists('price',$parameters)){
            return $this->productRepository->getOrderBy('price');
        }
        elseif(array_key_exists('category',$parameters)){
            // on this case we use the relation belongsToMany we already 
            // prepared in models to get the products of each category
            return $this->productRepository->getGroupByCategory($parameters['category']);
        }
        elseif($paginate){
            return $this->productRepository->getWithPaginate(10);
        }else{
            return $this->productRepository->getAll();
        }
    }

    /**
     * store Product .
     */
    public function storeProduct(array $data) : void
    {
        // Move Product Image to public folder
        $destinationPath = 'images/product'; // setup path destination
        $productImage = time() . "." . $data['image']->extension(); // change the image name to a unique name to make sure that the name are not repeated 
        $data['image']->move(public_path($destinationPath),$productImage); // image will be moved in 'public/images/product'
        $data['image'] = $productImage;
        // store data in table product
        $product = $this->productRepository->storeProduct($data);
        // now we check if user select a category to attched to the product 
        if(array_key_exists('category',$data))
            $product->categories()->attach($data['category']);
    }
    
    /**
     * update Product .
     */
    public function updateProduct(array $new_data , Product $product) : void
    {
        if(array_key_exists('image',$new_data)){
            $existslImage = public_path('images/product/' . $product->image);
            // check if the old image exists to deleted
            if (File::exists($existslImage)) {

                File::delete($existslImage);
            }
            // Move the new Product Image to public folder
            $destinationPath = 'images/product'; // setup path destination
            $productImage = time() . "." . $new_data['image']->extension(); // change the image name to a unique name to make sure that the name are not repeated 
            $new_data['image']->move(public_path($destinationPath),$productImage); // image will be moved in 'public/images/product'
            $new_data['image'] =  $productImage ;
        }
        $this->productRepository->updateProduct($new_data , $product);
    }

    /**
     * delete Product .
     */
    public function deleteProduct(Product $product) : void
    {
        // before deleting this product should delete the image with it
        if($product->image){
            $existslImage = public_path('images/product/' . $product->image);
            // check if image exists to deleted
            if (File::exists($existslImage)) {
                File::delete($existslImage);
            }
        }
        $this->productRepository->deleteProduct($product);
    }

    /**
     * attch category to product.
     */
    public function attch_category_to_product(int $product_id,int $category_id) : array
    {
        return $this->productRepository->attch_category_to_product($product_id , $category_id);

    }

    /**
     * detach category from product.
     */
    public function detach_category_from_product(int $product_id,int $category_id) : void
    {
        $this->productRepository->detach_category_from_product($product_id , $category_id);
    }
}
