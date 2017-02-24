<?php

use Illuminate\Database\Seeder;

class ProjectsStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects_status')->insert([
            'status_name'=>'Not approved'
        ]);
		DB::table('projects_status')->insert([
            'status_name'=>'Pending'
        ]);
		DB::table('projects_status')->insert([
            'status_name'=>'In progress'
        ]);
		DB::table('projects_status')->insert([
            'status_name'=>'Rejected'
        ]);
		
		DB::table('projects_status')->insert([
            'status_name'=>'Approved'
        ]);
    }
}
