<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminControllers extends Migration
{

    /**
     * Make changes to the database.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_controllers', function (Blueprint $table) {
            $table->create();
            $table->increments('id');
            $table->string('controller');
            $table->string('role_name');
            $table->integer('role_order');
            $table->integer('role_section');
            $table->timestamps();
        });
    }

    /**
     * Revert the changes to the database.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admin_controllers');
    }

}