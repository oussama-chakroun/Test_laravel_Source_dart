<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class AddCategory extends Command
{
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
        $args = $this->arguments();
        try{
            Category::create($args);
            dd( "insert with success" );

        }catch(\Exception $e){
            dd( "error" , $e->getMessage());

        }
    }
}
