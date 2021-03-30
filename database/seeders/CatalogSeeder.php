<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //esegui 5 volte la factory del modello Category
        Category::factory (5)
        //per ogni categoria crea 15 prodotti 
        ->has(Article::factory()->count(15))
        ->create();
    }
}
