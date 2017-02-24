<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProjectsStatusTableSeeder::class);
		$this->call(ProjectstypeTableSeeder::class);
		$this->call(UsersRoleTableSeeder::class);
		$this->call(UsersStatusTableSeeder::class);
    }
}
