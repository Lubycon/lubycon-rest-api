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
            $table->integer('job_id')->unsigned()->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->integer('log_group_id')->unsigned()->nullable();
            $table->integer('language_group_id')->unsigned()->nullable();
            $table->integer('career_group_id')->unsigned()->nullable();
            $table->enum('is_active', ['active','inactive','drop']);
            $table->integer('is_accept_terms')->unsigned();
            $table->integer('is_opened')->unsigned();
            $table->string('token',100)->nullable();
            $table->string('profile_img')->nullable();
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
            $table->dropColumn('job_id');
            $table->dropColumn('country_id');
            $table->dropColumn('log_group_id');
            $table->dropColumn('language_group_id');
            $table->dropColumn('career_group_id');
            $table->dropColumn('is_active');
            $table->dropColumn('is_accept_terms');
            $table->dropColumn('is_opened');
            $table->dropColumn('token');
            $table->dropColumn('profile_img');
            $table->dropColumn('company');
            $table->dropColumn('city');
            $table->dropColumn('telephone');
            $table->dropColumn('fax_number');
            $table->dropColumn('web_url');
        });
    }
}
