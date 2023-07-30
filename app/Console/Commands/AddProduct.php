<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class AddProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-product {name} {description} {price} {image}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add new product to database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $args = $this->arguments();
        try{
            Product::create($args);
            dd( "insert with success" );

        }catch(\Exception $e){
            dd( "error" , $e->getMessage());

        }
    }
}
