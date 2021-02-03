<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->string('nim',10)->primary();
            $table->string('id_auth',10);
            $table->string('id_kel',10);
            $table->string('nama',30);
            $table->text('alamat');
            $table->string('no_hp',15);
            $table->string('email',30);
            $table->enum('jk',['Laki-laki','Perempuan']);
            $table->enum('jurusan',['Teknik Informatika','Sistem Informasi','Manajemen Informatika']);
            $table->string('tahun',4);
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
        Schema::dropIfExists('students');
    }
}
