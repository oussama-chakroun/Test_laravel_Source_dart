<?php 

namespace App\Services ;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\File;

class ProductService
{
    public function getProducts($request){

        // to use oderBy and filter we check the request first 
        if($request->name && $request->price )

            return Product::orderBy('name')->orderBy('price')->paginate(10);

        elseif($request->name)

            return Product::orderBy('name')->paginate(10);

        elseif($request->price)

            return Product::orderBy('price')->paginate(10);

        elseif($request->category){

            // on this case we use the relation 
            // belongsToMany we already prepared 
            // in models to get the products of the each category
            return Category::find($request->category)->products;

        }
        else

            return Product::paginate(10);
    }

    public function createProduct($request){

        // validate request data to be stored
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:0.1',
            'img' => 'required|file',
        ]);

        // Move Product Image to public folder
        $destinationPath = 'images/product'; // setup path destination

        $productImage = time() . "." . $request->img->extension(); // change the image name to a unique name to make sure that the name are not repeated 

        $request->img->move(public_path($destinationPath),$productImage); // image will be moved in 'public/images/product'

        $request['image'] = $productImage;

        // store data in table product
        $product = Product::create($request->all());
        
        // now we check if user select a category to attched to the product 
        if($request->category)

            $product->categories()->attach($request->category);

    }

    public function updateProduct($request , $product){

        // validate request data to be stored
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:0.1',
        ]);

        // check if request have a new img to change with the old image
        if($request->img && $product->image) {

            $existslImage = public_path('images/product/' . $product->image);
            // check if the old image exists to deleted
            if (File::exists($existslImage)) {

                File::delete($existslImage);
            }

            // Move the new Product Image to public folder
            $destinationPath = 'images/product'; // setup path destination

            $productImage = time() . "." . $request->img->extension(); // change the image name to a unique name to make sure that the name are not repeated 

            $request->img->move(public_path($destinationPath),$productImage); // image will be moved in 'public/images/product'

            $request['image'] =  $productImage ;

        }elseif($request->img){

            // Move the new Product Image to public folder
            $destinationPath = 'images/product'; // setup path destination

            $productImage = time() . "." . $request->img->extension(); // change the image name to a unique name to make sure that the name are not repeated 

            $request->img->move(public_path($destinationPath),$productImage); // image will be moved in 'public/images/product'

            $request['image'] =  $productImage ;
        }
        
        $product->update($request->all());
    }

    public function deleteProduct($product){

        // before deleting this product should delete the image with it
        if($product->image){

            $existslImage = public_path('images/product/' . $product->image);

            // check if image exists to deleted
            if (File::exists($existslImage)) {
                File::delete($existslImage);
            }
        }
        
        $product->delete();
    } 
    
}
