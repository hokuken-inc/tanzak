<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSnippetTagTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
      Schema::create('snippet_tag', function($table)
      {
           $table->increments('id')->unsigned();
           $table->integer('snippet_id')->unsigned();
           $table->integer('tag_id')->unsigned();
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
  	  Schema::drop('snippet_tag');
	}

}
