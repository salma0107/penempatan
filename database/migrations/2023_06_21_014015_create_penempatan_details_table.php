<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penempatan_details', function (Blueprint $table) {
            $table->id();
            $table->string('no_penempatan')->nullable();
            $table->string('id_company')->nullable();
            $table->string('departmenCompany')->nullable();
            $table->string('posisi')->nullable();
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
        Schema::dropIfExists('penempatan_details');
    }
};
