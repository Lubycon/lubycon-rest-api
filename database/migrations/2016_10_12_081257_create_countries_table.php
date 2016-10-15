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
            $table->integer('country_id')->unsigned()->index();
            $table->tinyInteger('utc');
            $table->enum('region',[
                'east asia',
                'central asia',
                'south asia',
                'south west asia',
                'northern asia',
                'south east asia',
                'south west asia',
                'eastern europe',
                'central europe',
                'western europe',
                'southern europe',
                'northern europe',
                'south east europe',
                'south west europe',
                'eastern africa',
                'central africa',
                'western africa',
                'northern africa',
                'southern africa',
                'pacific',
                'west indies',
                'indian ocean',
                'undecided',
                'north america',
                'northern america',
                'south america',
                'central america',
            ]);
            $table->enum('continent',['asia', 'europe', 'africa', 'americas', 'oceania','undecided']);
            $table->string('name',255);
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
