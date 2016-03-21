<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColourTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('colour', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
		});
		// Insert Colours
		DB::table('colour')->insert(
			array(['name' => 'Red'],
			      ['name' => 'Orange'],
			      ['name' => 'Yellow'],
			      ['name' => 'Green'],
			      ['name' => 'Blue'],
			      ['name' => 'Indigo'],
			      ['name' => 'Violet']
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
		Schema::dropIfExists('colour');
	}
}
