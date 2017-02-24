<?php

use Illuminate\Database\Seeder;

class ProjectstypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects_type')->insert([
            'type_name'=>'Project'
        ]);
		DB::table('projects_type')->insert([
            'type_name'=>'Sub Project'
        ]);
    }
}
