<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {

            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->date('date');
            $table->bigInteger('livrebiblique_id')->unsigned()->index()->nullable();
            $table->string('reference')->nullable();
            $table->bigInteger('auteur_id')->unsigned()->index();
            $table->foreign('auteur_id')
                  ->references('id')->on('auteurs')
                  ->onDelete('cascade');
            $table->integer('duree')->nullable();
            $table->string('lien')->nullable();
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
        Schema::dropIfExists('messages');
    }
}
