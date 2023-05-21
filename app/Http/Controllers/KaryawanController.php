<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class KaryawanController extends Controller
{
    public function index(){
        $karyawan = Karyawan::all();
        return view('pages.karyawan.index', compact('karyawan'));
    }

    public function create(){
        return view('pages.karyawan.create');
    }

    public function store(Request $request){
        try{
            $request->validate([
                'nama' => 'required',
                'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
        
            $data = new Karyawan();

            $data->ktp = $request->ktp;
            $data->nik = $request->nik;
            $data->nama = $request->nama;
            $data->alamat = $request->alamat;
            $data->jabatan = $request->jabatan;
            $data->organisasi = $request->organisasi;
            $data->status_kontrak = $request->status_kontrak;
            $data->joindate = $request->joindate;
            $data->berakhirkontrak = $request->berakhirkontrak;
            $data->email = $request->email;
            $data->telepon = $request->telepon;
            $data->status_pernikahan = $request->status_pernikahan;
            $data->agama = $request->agama;
            $data->tanggal_lahir = $request->tanggal_lahir;
            $data->tempat_lahir = $request->tempat_lahir;
            $data->jenis_kelamin = $request->jenis_kelamin;
            if ($request->hasFile('gambar')) {
                $image = $request->file('gambar');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images');
                $image->move($destinationPath, $filename);
                $data->gambar = $filename;
            }
            $data->save();
            $level = '2';
            $remember_token = Str::random(10);
            User::create([
                'id' => $request->nik,
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->ktp),
                'nik' => $request->nik,
                'level' => $level,
                'remember_token' => Hash::make($remember_token),
            ]);

            
                return redirect()->route('karyawan.index')->with(['success' => 'Data Berhasil Disimpan!']);
            }catch (ValidationException $exception) {
                $errorMessage = $exception->validator->errors()->first(); // ambil pesan error pertama dari validator
                redirect()->route('karyawan.index')->with('error', 'Gagal menyimpan data. ' . $errorMessage); // tambahkan alert error
            }
    }
}
