<?php

namespace App\Http\Controllers;

use App\Jabatan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatan = Jabatan::all();
        return view('pages.jabatan.index', compact('jabatan'));
    }

    public function create()
    {
        return view('pages.jabatan.create');
    }

    public function edit()
    {
        return view('pages.jabatan.edit');
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'nama' => 'required'
            ]);
        
            $data = new Jabatan();

            $data->nama = $request->nama;
            $data->level = $request->level;
           
            $data->save();
            
                return redirect()->route('jabatan.index')->with(['success' => 'Jabatan Baru Berhasil Dibuat!']);
            }catch (ValidationException $exception) {
                $errorMessage = $exception->validator->errors()->first(); // ambil pesan error pertama dari validator
                redirect()->route('jabatan.index')->with('error', 'Gagal menyimpan data. ' . $errorMessage); // tambahkan alert error
            }
    }
}
