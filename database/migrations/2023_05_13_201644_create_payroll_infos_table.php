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
        Schema::create('payroll_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_id');
            $table->string('nama_karyawan');
            $table->string('jenis_gaji');
            $table->BigInteger('gaji_pokok');
            $table->string('is_use_tk');
            $table->BigInteger('tarif_tk');
            $table->string('is_use_ks');
            $table->BigInteger('tarif_ks');
            $table->BigInteger('npwp');
            $table->BigInteger('tanggungan');
            $table->BigInteger('kinerja');
            $table->BigInteger('makan');
            $table->BigInteger('lembur');
            $table->BigInteger('struktural');
            $table->BigInteger('fungsional');
            $table->BigInteger('fasilitas');
            $table->BigInteger('prestasi');
            $table->BigInteger('lain-lain');
            $table->BigInteger('potonganhutang');
            $table->BigInteger('potonganmess');
            $table->BigInteger('potongankerja');
            $table->BigInteger('jht');
            $table->BigInteger('pensiun');
            $table->BigInteger('kesehatan');
            $table->BigInteger('pph21');
            $table->BigInteger('takehomepay');
            $table->string('info_bpjs')->nullable();
            $table->string('info_pajak')->nullable();
            // Tambahkan kolom lainnya sesuai kebutuhan

            $table->timestamps();

            $table->foreign('karyawan_id')->references('id')->on('karyawan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payroll_infos');
    }
};
