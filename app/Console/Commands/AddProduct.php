<?php

namespace App\Console\Commands;

use App\Services\ProductService;
use Illuminate\Console\Command;

class AddProduct extends Command
{
    public function __construct(protected ProductService $productService)
    {
        parent::__construct();
    }
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
        $data = $this->arguments();
        try{
            $this->productService->storeProduct($data);
            dd( "insert with success" );
        }catch(\Exception $e){
            dd( "error" , $e->getMessage());

        }
    }
}
