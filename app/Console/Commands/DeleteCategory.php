<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class DeleteCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-category {idOrName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a category from database by id or name';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // there are two possibilities on $arg name or id
        $arg = $this->argument('idOrName');
        try{

            $category = Category::where('id' , '=' ,$arg)->orWhere('name' , '=' , $arg)->first();

            if($category){
                $category->delete();
                dd( "deleted with success" );
            }
            else{
                dd( "category not found !" );
            }

        }catch(\Exception $e){
            dd( "error" , $e->getMessage());

        }
    }
}
