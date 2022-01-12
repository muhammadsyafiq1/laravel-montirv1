<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PenyesuaianTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('no_hp')->nullable();
            $table->text('alamat')->nullable();
            $table->string('role')->nullable(); //admin //montir //customer
            $table->string('jenis_kelamin')->nullable();
            $table->string('lingkup_wilayah')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('pengalaman')->nullable();
            $table->string('tentang')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('nama_bengkel')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
