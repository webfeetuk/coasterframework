<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminMenu extends Migration
{

    /**
     * Make changes to the database.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_menu', function (Blueprint $table) {
            $table->create();
            $table->increments('id');
            $table->integer('action_id');
            $table->integer('parent');
            $table->integer('order');
            $table->string('icon');
            $table->string('item_name');
            $table->string('item_desc')->nullable();
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
        Schema::drop('admin_menu');
    }

}