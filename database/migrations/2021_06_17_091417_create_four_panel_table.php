<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFourPanelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('four_panel', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('fournisseur_id')->unsigned();
            $table->bigInteger('panel_id')->unsigned();
            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs')->onDelete("cascade");
            $table->foreign('panel_id')->references('id')->on('panels')->onDelete("cascade");
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
        Schema::dropIfExists('four_panel');
    }
}
