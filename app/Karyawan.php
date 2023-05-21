<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'karyawan';
    protected $fillable = [
        'id','nama', 'alamat', 'email', 'telepon', 'tanggal_lahir', 'tempat_lahir', 'jenis_kelamin', 'foto', 'ktp','nik',
    ];

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payrolls()
    {
        return $this->hasMany(Payroll::class);
    }

    public function payrollinfo()
    {
        return $this->hasMany(PayrollInfo::class);
    }

    public function payrollComponents()
    {
        return $this->belongsToMany(PayrollComponent::class, 'karyawan_payroll_components')
            ->withPivot('jumlah');
    }
}
