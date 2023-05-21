<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollInfo extends Model
{
    use HasFactory;
    protected $table = 'payroll_infos';
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
