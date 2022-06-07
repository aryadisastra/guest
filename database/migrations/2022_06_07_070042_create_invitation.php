<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitation', function (Blueprint $table) {
            $table->id();
            $table->text('id_invitation');
            $table->integer('id_agenda');
            $table->integer('tamu');
            $table->text('qr_code');
            $table->text('value');
            $table->integer('status')->default(1)->comment('[1.berlaku, 2.kadaluarsa]');
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
        Schema::dropIfExists('invitation');
    }
}
