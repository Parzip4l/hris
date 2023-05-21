<?php

namespace App\Http\Controllers;

use App\User;
use App\Pengumuman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::all();
        return view('pages.pengumuman.index', compact('pengumuman'));
    }

    public function create()
    {
        return view('pages.pengumuman.create');
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'judul' => 'required',
                'lampiran' => 'nullable|file|max:4096'
            ]);
        
            $data = new Pengumuman();

            $data->judul = $request->judul;
            $data->isi = $request->isi;
            if ($request->hasFile('lampiran')) {
                $image = $request->file('lampiran');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/files');
                $image->move($destinationPath, $filename);
                $data->lampiran = $filename;
            }
            $data->save();
            
                return redirect()->route('pengumuman.index')->with(['success' => 'Pengumuman Berhasil Dibuat!']);
            }catch (ValidationException $exception) {
                $errorMessage = $exception->validator->errors()->first(); // ambil pesan error pertama dari validator
                redirect()->route('pengumuman.index')->with('error', 'Gagal menyimpan data. ' . $errorMessage); // tambahkan alert error
            }
            
    }

    public function download($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        $file_path = public_path('files/' .$pengumuman->lampiran);

        return response()->download($file_path);
    }
}
