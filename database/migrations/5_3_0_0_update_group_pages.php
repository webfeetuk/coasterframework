<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateGroupPages extends Migration
{

    /**
     * Make changes to the database.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('in_group');
            $table->integer('group_container_url_priority')->default(0)->after('group_container');
            $table->integer('canonical_parent')->default(0)->after('group_container_url_priority');
        });

        Schema::table('page_group', function (Blueprint $table) {
            $table->dropColumn('default_parent');
            $table->dropColumn('order_by_attribute_id');
            $table->dropColumn('order_dir');
            $table->integer('url_priority')->default(50)->after('item_name');
        });

        Schema::table('page_group_attributes', function (Blueprint $table) {
            $table->integer('item_block_order_priority')->default(0)->after('item_block_id');
            $table->string('item_block_order_dir')->default('asc')->after('item_block_order_priority');
            $table->integer('filter_by_block_id')->default(0)->change();
        });
    }

    /**
     * Revert the changes to the database.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->integer('in_group')->default(0);
            $table->dropColumn('group_container_url_priority');
            $table->dropColumn('canonical_parent');
        });

        Schema::table('page_group', function (Blueprint $table) {
            $table->integer('default_parent');
            $table->integer('order_by_attribute_id')->nullable();
            $table->string('order_dir')->nullable();
            $table->dropColumn('url_priority');
        });

        Schema::table('page_group_attributes', function (Blueprint $table) {
            $table->dropColumn('item_block_order_priority');
            $table->dropColumn('item_block_order_dir');
        });
    }

}
