<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('setifikats', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->string('tujuan_sertifikat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('setifikats', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('tujuan_sertifikat');
        });
    }
}
