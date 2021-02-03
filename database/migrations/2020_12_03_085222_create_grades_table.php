<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->string('id_nilai',10)->primarykey();
            $table->string('nim',10);
            $table->string('id_pengajuan',10);
            $table->string('id_bimbingan',10);
            $table->string('id_sidang',10);
            $table->double('nilai_pengajuan');
            $table->double('nilai_bimbingan');
            $table->double('nilai_sidang');
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
        Schema::dropIfExists('grades');
    }
}
