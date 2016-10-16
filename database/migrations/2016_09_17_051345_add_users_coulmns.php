<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsersCoulmns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->timestamp('last_login_time')->nullable();
            $table->integer('job')->unsigned()->nullable();
            $table->integer('country')->unsigned()->nullable();
            $table->enum('is_active', ['active','inactive','drop']);
            $table->string('is_accept_terms',255);
            $table->string('is_opened',255);
            $table->string('token',100)->nullable();
            $table->string('profile_img')->nullable();
            $table->string('description',255)->nullbable();
            $table->string('company',255)->nullable();
            $table->string('city',255)->nullable();
            $table->string('telephone',255)->nullable();
            $table->string('fax_number',255)->nullable();
            $table->string('web_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('last_login_time');
            $table->dropColumn('job');
            $table->dropColumn('country');
            $table->dropColumn('is_active');
            $table->dropColumn('is_accept_terms');
            $table->dropColumn('is_opened');
            $table->dropColumn('token');
            $table->dropColumn('profile_img');
            $table->dropColumn('company');
            $table->dropColumn('description');
            $table->dropColumn('city');
            $table->dropColumn('telephone');
            $table->dropColumn('fax_number');
            $table->dropColumn('web_url');
        });
    }
}
