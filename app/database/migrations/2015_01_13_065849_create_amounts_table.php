<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('amounts', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('order_id', 32);
            $table->integer('user_id');
            $table->string('nickname', 32);
            $table->integer('game_id');
            $table->string('game_title', 32);
            $table->string('server', 32);
            $table->decimal('pay', 10, 2);
            $table->decimal('spend', 10, 2);
            $table->boolean('platform_received');
            $table->boolean('game_received');
            $table->timestamp('platform_received_at');
            $table->timestamp('game_received_at');
            $table->string('pay_method');
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
		Schema::drop('amounts');
	}

}
