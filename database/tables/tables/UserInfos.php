<?php
namespace database\tables\tables;
use Illuminate\Database\Capsule\Manager as Capsule;

class UserInfos{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		 Capsule::schema()->create('user_infos', function( $table)
		 {
			 $table->increments('id');
			 $table->integer('user_id')->index();
			 $table->string('name',76);
			 $table->boolean('gender');
			 $table->string('phone',36);
			 $table->date('birthday');
			 $table->text('image');
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
		Capsule::schema()->drop('user_infos');
	}

}
