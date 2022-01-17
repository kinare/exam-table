<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        Category::insert([
            [ 'name' => 'technical', 'description' => 'Technical' ],
            [ 'name' => 'aptitude', 'description' => 'Aptitude' ],
            [ 'name' => 'logical', 'description' => 'Logical' ],
        ]);
    }
}
