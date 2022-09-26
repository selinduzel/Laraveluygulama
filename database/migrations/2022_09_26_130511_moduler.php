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
        Schema::create('moduler', function (Blueprint $table) {
            $table->id();
            $table->string('baslik');
            $table->string('seflink');
            $table->enum('durum',[1,2])->default(1);/*1 aktif 2pasif*/
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
        Schema::dropIfExists('moduler');
    }
};
