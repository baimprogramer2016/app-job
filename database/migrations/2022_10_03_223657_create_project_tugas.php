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
        Schema::create('project_tugas', function (Blueprint $table) {
            $table->id();
            $table->string("kodeproject");
            $table->string("kodepengguna");
            $table->string("subject");
            $table->string("deskripsi");
            $table->date("tanggal");
            $table->date("tanggalakhir");
            $table->string("status");
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
        Schema::dropIfExists('project_tugas');
    }
};
