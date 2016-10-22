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
            $table->string('token',100)->nullable();
            $table->string('profile_img')->nullable();
            $table->string('description',255)->nullbable();
            $table->string('company',255)->nullable();
            $table->string('city',255)->nullable();
            $table->string('mobile',255)->nullable();
            $table->string('fax',255)->nullable();
            $table->string('web')->nullable();
            $table->enum('email_public',['Public','Private'])->default('Public');
            $table->enum('mobile_public',['Public','Private'])->default('Public');
            $table->enum('fax_public',['Public','Private'])->default('Public');
            $table->enum('web_public',['Public','Private'])->default('Public');
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
            $table->dropColumn('token');
            $table->dropColumn('profile_img');
            $table->dropColumn('company');
            $table->dropColumn('description');
            $table->dropColumn('city');
            $table->dropColumn('mobile');
            $table->dropColumn('fax');
            $table->dropColumn('web');
            $table->dropColumn('email_public');
            $table->dropColumn('mobile_public');
            $table->dropColumn('fax_public');
            $table->dropColumn('web_public');

        });
    }
}
