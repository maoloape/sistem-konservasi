<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('konservasi', function (Blueprint $table) {
            $table->id();
            $table->string('das');
            $table->string('sub_das');
            $table->string('kabupaten');
            $table->string('kecamatan');
            $table->string('desa');
            $table->string('blok');
            $table->float('bt', 10,6);
            $table->float('ls', 10,6);
            $table->float('p');
            $table->float('l');
            $table->float('t');
            $table->float('volume');
            $table->string('jenis_batu');
            $table->string('jenis_kawat');
            $table->string('create_in');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konservasi');
    }
};
