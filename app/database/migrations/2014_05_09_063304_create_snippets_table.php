<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSnippetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
      //
      Schema::create('snippets', function($table)
      {
           $table->increments('id')->unsigned();
           $table->integer('category_id')->unsigned();
           $table->string('title')->nullable();
           $table->text('note')->nullable();
           $table->text('body');
           $table->text('tag')->nullable();
           $table->integer('prority')->unsigined()->default(9999);
           $table->text('image')->nullable();
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
  	  Schema::drop('snippets');
	}

}
