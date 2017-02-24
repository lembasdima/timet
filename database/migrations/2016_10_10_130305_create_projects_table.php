<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function(Blueprint $table){
			$table->increments('id');
			$table->string('project_name');
			$table->string('project_description');
			$table->integer('project_customer');
			$table->integer('project_budget_time');
			$table->float('project_budget_money');
			$table->string('project_lead');
			$table->integer('project_type');
			$table->integer('project_status');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
