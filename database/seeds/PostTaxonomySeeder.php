<?php

use Illuminate\Database\Seeder;

class PostTaxonomySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Post_taxonomy::class, 10)->create(); 
    }
}
