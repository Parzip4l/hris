<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollComponent extends Model
{
    use HasFactory;
    protected $table = 'payroll_components';

    protected $fillable = ['nik', 'nama_komponen', 'jumlah'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
