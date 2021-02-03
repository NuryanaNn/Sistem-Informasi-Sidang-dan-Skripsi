<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuidancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guidances', function (Blueprint $table) {
            $table->bigIncrements('id_bimbingan');
            $table->string('nim',10);
            $table->text('file_bab');
            $table->text('keterangan');
            $table->date('tanggal');
            $table->enum('status_1',['proses','terima','revisi']);
            $table->enum('status_2',['proses','terima','revisi']);
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
        Schema::dropIfExists('guidances');
    }
}
