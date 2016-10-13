<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('country_id');
            $table->tinyInteger('utc');
            $table->enum('region',['east asia', 'central asia', 'south asia', 'northern asia', 'south east asia', 'south west asia', 'eastern europe', 'central europe', 'western europe', 'southern europe', 'northern europe', 'south east europe','south west europe', 'eastern africa', 'central africa', 'western africa','northern africa','southern africa']);
            $table->enum('continent',['asia', 'europe', 'africa', 'americas', 'oceania','undecided']);
            $table->string('name',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('countries');
    }
}
