<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

  	/**
  	 * Run the migrations.
  	 *
  	 * @return void
  	 */
  	public function up()
  	{
  		//
          Schema::create('users', function($table)
          {
               $table->increments('id')->unsigned();
               $table->string('name')->unique();
               $table->string('email')->unique();
               $table->string('password');
               $table->string('remember_token')->after('picture')->default('');
               $table->timestamps();
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
        Schema::drop('users');
/*
        Schema::table('users', function(Blueprint $table)
        {
            $table->dropColumn('remember_token');
        });
*/
    }

}
