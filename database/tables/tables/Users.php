<?php
namespace database\tables\tables;
use Illuminate\Database\Capsule\Manager as Capsule;

class Users	{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		 Capsule::schema()->create('users', function( $table)
		 {
			$table->increments('id');
		 	$table->boolean('type');
		 	$table->string('account',38)->unique();
		 	$table->string('password', 38);
		 	$table->rememberToken('token',76);
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
		Capsule::schema()->drop('users');
	}

}
