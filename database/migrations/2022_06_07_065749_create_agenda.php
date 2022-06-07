<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgenda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            $table->text('acara');
            $table->date('tanggal_dimulai');
            $table->date('tanggal_selesai');
            $table->integer('koordinator')->nullable(true);
            $table->text('tempat')->nullable(true);
            $table->integer('anggaran')->nullable(true);
            $table->text('catatan')->nullable(true);
            $table->integer('created_by');
            $table->integer('status')->default(0)->comment('[0:belum Dimulai, 1: Acara Sedang Berlangsung, 2:Acara Selesai]');
            $table->integer('status_persetujuan')->default(1);
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
        Schema::dropIfExists('agenda');
    }
}
