<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminActions extends Migration
{

    /**
     * Make changes to the database.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_actions', function (Blueprint $table) {
            $table->create();
            $table->increments('id');
            $table->integer('controller_id');
            $table->string('action');
            $table->integer('inherit')->default(0);
            $table->integer('edit_based')->default(0);
            $table->string('name');
            $table->text('about')->nullable();
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
        Schema::drop('admin_actions');
    }

}