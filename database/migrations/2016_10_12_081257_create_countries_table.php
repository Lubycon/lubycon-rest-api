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
                'East Asia',
                'Central Asia',
                'South Asia',
                'South West Asia',
                'Northern Asia',
                'South East Asia',
                'South West Asia',
                'Eastern Europe',
                'Central Europe',
                'Western Europe',
                'Southern Europe',
                'Northern Europe',
                'South East Europe',
                'South West Europe',
                'Eastern Africa',
                'Central Africa',
                'Western Africa',
                'Northern Africa',
                'Southern Africa',
                'Pacific',
                'West Indies',
                'Indian Ocean',
                'Undecided',
                'North America',
                'Northern America',
                'South America',
                'Central America',
            ]);
            $table->enum('continent',['Asia', 'Europe', 'Africa', 'Americas', 'Oceania','Undecided']);
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
