<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifieUsersTableSnsAndDeleteToken extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->softDeletes();
            $table->integer('sns_id')->nullable();
            $table->enum('is_sns_user', ['0100','0101','0102'])->nullable();
            $table->dropColumn('token');
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
            $table->dropColumn('sns_id');
            $table->dropColumn('is_sns_user');
            $table->string('token', 100)->nullable();
        });
    }
}
