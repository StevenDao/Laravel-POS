<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSizeTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('size', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->double('multi', 3, 2);
			$table->timestamps();
		});
		// Insert Sizes
		DB::table('size')->insert(
			array(['name' => 'XS', 'multi' => 1],
			      ['name' => 'S', 'multi' => 1.25],
			      ['name' => 'M', 'multi' => 1.5],
			      ['name' => 'L', 'multi' => 1.75],
			      ['name' => 'XL', 'multi' => 2]
			)
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('size');
	}
}
