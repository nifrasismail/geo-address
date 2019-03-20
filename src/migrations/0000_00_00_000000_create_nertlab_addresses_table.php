<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNertlabAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nertlab_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('country_code');
            $table->string('state_code');
            $table->string('state_name');
            $table->string('province_code');
            $table->string('province_name');
            $table->string('community_code');
            $table->string('community_name');
            $table->string('postal_code');
            $table->string('latitude');
            $table->string('longitude');
            $table->integer('accuracy');
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
        Schema::dropIfExists('nertlab_addresses');
    }
}
