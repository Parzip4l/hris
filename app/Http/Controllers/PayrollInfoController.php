<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;
use App\PayrollInfo;

class PayrollInfoController extends Controller
{
    public function index()
    {
        $payrollinfo = PayrollInfo::all();
        return view('pages.infopayroll.index', compact('payrollinfo'));
    }

    public function create()
    {
        return view('pages.infopayroll.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_karyawan' => 'required',
            'karyawan_id' => 'required|numeric',
            'nik' => 'required|numeric',
            'jenis_gaji' => 'required',
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);

        // Buat instance PayrollInfo dan isi dengan data yang valid
        $payrollInfo = new PayrollInfo();
        $payrollInfo->nama_karyawan = $request->nama_karyawan;
        $payrollInfo->karyawan_id = $request->karyawan_id;
        $payrollInfo->nik = $request->nik;
        $payrollInfo->jenis_gaji = $request->jenis_gaji;
        $payrollInfo->gaji_pokok = $request->gaji_pokok;
        $payrollInfo->npwp = $request->npwp;
        $payrollInfo->is_use_tk = $request->is_use_tk;
        $payrollInfo->tarif_tk = $request->tarif_tk;
        $payrollInfo->is_use_ks = $request->is_use_ks;
        $payrollInfo->tarif_ks = $request->tarif_ks;
        $payrollInfo->tanggungan = $request->tanggungan;
        $payrollInfo->kinerja = $request->kinerja;
        $payrollInfo->makan = $request->makan;
        $payrollInfo->lembur = $request->lembur;
        $payrollInfo->struktural = $request->struktural;
        $payrollInfo->fungsional = $request->fungsional;
        $payrollInfo->fasilitas = $request->fasilitas;
        $payrollInfo->prestasi = $request->prestasi;
        $payrollInfo->lain_lain = $request->lain_lain;
        $payrollInfo->potonganhutang = $request->potonganhutang;
        $payrollInfo->potonganmess = $request->potonganmess;
        $payrollInfo->potongankerja = $request->potongankerja;
        $payrollInfo->jht = $request->jht;
        $payrollInfo->pensiun = $request->pensiun;
        $payrollInfo->kesehatan = $request->kesehatan;
        $payrollInfo->pph21 = $request->pph21;
        $payrollInfo->takehomepay = $request->takehomepay;
        // Isi atribut lainnya sesuai kebutuhan

        // Simpan data ke database
        $payrollInfo->save();

        // Redirect atau lakukan tindakan lain setelah menyimpan data
        return redirect()->route('payroll-info.index')->with('success', 'Data payroll berhasil disimpan.');
    }

    public function autocomplete(Request $request)
    {
        $term = $request->input('term');
        $karyawan = Karyawan::select('id', 'nik', 'nama')
            ->where('nama', 'LIKE', '%' . $term . '%')
            ->get();
        
        $response = array();
        foreach($karyawan as $user){
            $response[] = array(
                'id' => $user->id,
                'nik' => $user->nik,
                'value' => $user->nama
            );
        }
        
        return response()->json($response);
    }
}
