<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;
    protected $table = 'payrol';
    protected $fillable = [
        'nik',
        'periode',
        'basic_salary',
        'allowances',
        'deductions',
        'overtimepay',
        'takehomepay',
        'payment',
        'date',
    ];
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
