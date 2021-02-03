<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionsProposalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions_proposal', function (Blueprint $table) {
            $table->bigIncrements('id_pp');
            $table->string('nim',10);
            $table->text('topik_skripsi');
            $table->text('file_krs');
            $table->text('file_khs');
            $table->text('file_proposal');
            $table->enum('status',['proses','terima','tolak']);
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
        Schema::dropIfExists('submissions_proposal');
    }
}
