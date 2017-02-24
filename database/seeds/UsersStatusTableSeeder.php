<?php

use Illuminate\Database\Seeder;

class UsersStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_status')->insert([
            'status_name'=>'Not approved'
        ]);
		DB::table('users_status')->insert([
            'status_name'=>'Pending'
        ]);
		DB::table('users_status')->insert([
            'status_name'=>'In progress'
        ]);
		DB::table('users_status')->insert([
            'status_name'=>'Rejected'
        ]);
		
		DB::table('users_status')->insert([
            'status_name'=>'Approved'
        ]);
    }
}
