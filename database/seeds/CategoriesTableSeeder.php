<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'code'=>'DemoC1',
            'name'=>'Demo Category 1',
            'description'=>'This is a demo category',
        ]);
    }
}
