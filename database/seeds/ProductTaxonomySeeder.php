<?php

use Illuminate\Database\Seeder;

class ProductTaxonomySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Product_taxonomy::class, 10)->create(); 
    }
}
