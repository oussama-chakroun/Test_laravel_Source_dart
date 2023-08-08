<?php

namespace App\Console\Commands;

use App\Services\CategoryService;
use Illuminate\Console\Command;

class AddCategory extends Command
{
    public function __construct(protected CategoryService $categoryService)
    {
        parent::__construct();
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-category {name} {parent_category?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add new category to database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = $this->arguments();
        try{
            $this->categoryService->storeCategory($data);
            dd( "insert with success" );

        }catch(\Exception $e){
            dd( "error" , $e->getMessage());

        }
    }
}
