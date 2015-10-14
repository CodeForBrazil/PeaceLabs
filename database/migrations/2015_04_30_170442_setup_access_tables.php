<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class SetupAccessTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table(config('auth.table'), function ($table) {
			$table->tinyInteger('status')->after('password')->default(1);
		});

		Schema::create(config('access.roles_table'), function ($table) {
			$table->increments('id')->unsigned();
			$table->string('name')->unique();
			$table->boolean('all')->default(false);
			$table->smallInteger('sort')->default(0);
			$table->timestamps();
		});

		Schema::create(config('access.assigned_roles_table'), function ($table) {
			$table->increments('id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->integer('role_id')->unsigned();
			$table->foreign('user_id')
				->references('id')
				->on(config('auth.table'))
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->foreign('role_id')->references('id')->on(config('access.roles_table'));
		});

		Schema::create(config('access.permissions_table'), function ($table) {
			$table->increments('id')->unsigned();
			$table->integer('group_id')->nullable();
			$table->string('name')->unique();
			$table->string('display_name');
			$table->boolean('system')->default(false);
			$table->smallInteger('sort')->default(0);
			$table->timestamps();
		});

		Schema::create(config('access.permission_group_table'), function ($table) {
			$table->increments('id')->unsigned();
			$table->integer('parent_id')->nullable();
			$table->string('name');
			$table->smallInteger('sort')->default(0);
			$table->timestamps();
		});

		Schema::create(config('access.permission_role_table'), function ($table) {
			$table->increments('id')->unsigned();
			$table->integer('permission_id')->unsigned();
			$table->integer('role_id')->unsigned();
			$table->foreign('permission_id')
				->references('id')
				->on(config('access.permissions_table'));
			$table->foreign('role_id')
				->references('id')
				->on(config('access.roles_table'));
		});

		Schema::create(config('access.permission_dependencies_table'), function ($table) {
			$table->increments('id')->unsigned();
			$table->integer('permission_id')->unsigned();
			$table->integer('dependency_id')->unsigned();
			$table->foreign('permission_id')
				->references('id')
				->on(config('access.permissions_table'));
			$table->foreign('dependency_id')
				->references('id')
				->on(config('access.permissions_table'));
			$table->timestamps();
		});

		Schema::create(config('access.permission_user_table'), function ($table) {
			$table->increments('id')->unsigned();
			$table->integer('permission_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->foreign('permission_id')
				->references('id')
				->on(config('access.permissions_table'));
			$table->foreign('user_id')
				->references('id')
				->on(config('auth.table'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table(config('auth.table'), function(Blueprint $table)
		{
			$table->dropColumn('status');
		});

		Schema::table(config('access.assigned_roles_table'), function (Blueprint $table) {
			$table->dropForeign(config('access.assigned_roles_table').'_user_id_foreign');
			$table->dropForeign(config('access.assigned_roles_table').'_role_id_foreign');
		});

		Schema::table(config('access.permission_role_table'), function (Blueprint $table) {
			$table->dropForeign(config('access.permission_role_table').'_permission_id_foreign');
			$table->dropForeign(config('access.permission_role_table').'_role_id_foreign');
		});

		Schema::table(config('access.permission_user_table'), function (Blueprint $table) {
			$table->dropForeign(config('access.permission_user_table').'_permission_id_foreign');
			$table->dropForeign(config('access.permission_user_table').'_user_id_foreign');
		});

		Schema::table(config('access.permission_dependencies_table'), function (Blueprint $table) {
			$table->dropForeign('permission_dependencies_permission_id_foreign');
			$table->dropForeign('permission_dependencies_dependency_id_foreign');
		});

		Schema::drop(config('access.assigned_roles_table'));
		Schema::drop(config('access.permission_role_table'));
		Schema::drop(config('access.permission_user_table'));
		Schema::drop(config('access.permission_group_table'));
		Schema::drop(config('access.roles_table'));
		Schema::drop(config('access.permissions_table'));
		Schema::drop(config('access.permission_dependencies_table'));
	}
}
