<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbacksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('feedbacks', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->integer('user_id');
            $table->enum('type', ['game', 'pay', 'login', 'other']);
            $table->enum('cat', ['queryorsuggest', 'complain']);
            $table->string('email');
            $table->string('mobile', 15);
            $table->string('content');
            $table->enum('status', ['needreply', 'replied', 'over']);
            $table->boolean('readed');
            $table->text('addtion');
            $table->integer('admin_id');
            $table->string('admin', 32);
            $table->softDeletes();
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
		Schema::drop('keywords');
	}

}
