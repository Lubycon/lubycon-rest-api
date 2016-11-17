<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsersTableIsAdmin extends Migration
{
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->enum('grade',['admin','user'])->default('user');
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
            $table->dropColumn('grade');
        });
    }
}
