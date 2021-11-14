<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateMovementsTable.
 */
class CreateMovementsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('movements', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('group_id');
            $table->unsignedInteger('product_id');
            $table->decimal('value');
            $table->integer('type');
            $table->timestampsTz();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('product_id')->references('id')->on('products');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('movements', function (Blueprint $table) {
            $table->dropForeign('movements_user_id_foreign');
            $table->dropForeign('movements_group_id_foreign');
            $table->dropForeign('movements_product_id_foreign');
        });

        Schema::drop('movements');
	}
}
