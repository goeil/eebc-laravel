<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvenementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->bigInteger('type_id')->unsigned()->index();
            $table->bigInteger('lieu_id')->unsigned()->index();
            $table->bigInteger('organisateur_id')->unsigned()->index();
            $table->datetime('horaire');
            $table->timestamps();
            $table->foreign('type_id')
                  ->references('id')->on('type_evenements')
                  ->onDelete('cascade');
            $table->foreign('lieu_id')
                  ->references('id')->on('lieu_evenements')
                  ->onDelete('cascade');
            $table->foreign('organisateur_id')
                  ->references('id')->on('organisateur_evenements')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evenements');
    }
}
