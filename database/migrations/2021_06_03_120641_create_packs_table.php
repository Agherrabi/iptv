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
            $table->string('label')->nullable();
            $table->date('date_creation')->nullable();
            $table->date('date_experation')->nullable();
            $table->string('status')->nullable();
            $table->string('forniceur')->nullable();
            $table->string('serveur')->nullable();
            $table->string('panel')->nullable();
            $table->string('username')->nullable();
            $table->integer('period_abonnement')->nullable();
            $table->float('prix')->nullable();
            $table->float('avence')->default('0')->nullable();
            $table->float('reste')->nullable();
            $table->string('moyen_paiment')->nullable();
            $table->string('status_paiment')->nullable();
            $table->string('m3u')->nullable();
            $table->text('remarque')->nullable();
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
