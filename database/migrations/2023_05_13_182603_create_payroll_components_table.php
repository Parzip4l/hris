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
        Schema::create('payroll_components', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nik');
            $table->string('nama_komponen');
            $table->decimal('jumlah', 10, 2);
            $table->timestamps();

            $table->foreign('nik')
                ->references('nik')
                ->on('karyawan')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payroll_components');
    }
};
