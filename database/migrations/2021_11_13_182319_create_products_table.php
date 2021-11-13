<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateProductsTable.
 */
class CreateProductsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('institution_id');
            $table->string('name', 45);
            $table->text('description');
            $table->decimal('interest_rate');
            $table->string('index');
            $table->timestampsTz();
            $table->softDeletes();

            $table->foreign('institution_id')->references('id')->on('institutions');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_institution_id_foreign');
        });

		Schema::dropIfExists('products');
	}
}
