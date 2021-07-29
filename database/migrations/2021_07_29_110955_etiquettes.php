<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Etiquettes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etiquettes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("nom");
            $table->timestamps();
        });
        Schema::create('taggables', function (Blueprint $table) {
            $table->integer("etiquette_id");
            $table->integer("taggable_id");
            $table->string("taggable_type");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etiquettes');
        Schema::dropIfExists('taggables');
    }
}
