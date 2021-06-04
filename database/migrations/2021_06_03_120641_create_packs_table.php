<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->unsigned();
            $table->string('label');
            $table->date('date_creation');
            $table->date('date_experation');
            $table->string('status');
            $table->string('forniceur');
            $table->string('serveur');
            $table->string('panel');
            $table->string('username');
            $table->integer('period_abonnement');
            $table->float('prix');
            $table->float('avence');
            $table->float('reste');
            $table->string('moyen_paiment');
            $table->string('status_paiment');
            $table->string('m3u');
            $table->text('remarque');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete("cascade");
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
        Schema::dropIfExists('packs');
    }
}
