<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class DeleteProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-product {idOrName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a product from database by id or name';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // there are two possibilities on $arg name or id
        $arg = $this->argument('idOrName');
        try{

            $product = Product::where('id' , '=' ,$arg)->orWhere('name' , '=' , $arg)->first();

            if($product){
                $product->delete();
                dd( "deleted with success" );
            }
            else{
                dd( "product not found !" );
            }

        }catch(\Exception $e){
            dd( "error" , $e->getMessage());

        }
    }
}
