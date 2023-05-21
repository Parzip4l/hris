<?php

namespace App\Http\Controllers;

use App\Karyawan;
use App\PayrollComponent;
use Illuminate\Http\Request;

class PayrollComponentController extends Controller
{

    public function index()
    {
        $payrollComponents = PayrollComponent::all();
        return view('pages.payroll-component.index', compact('payrollComponents'));
    }
    public function create()
    {
        return view('pages.payroll-component.create');
    }

    public function store(Request $request)
    {
            $data = new PayrollComponent();

            $data->nama_komponen = $request->nama_komponen;
            $data->jenis = $request->jenis;
            $data->save();
            
            return redirect()->route('payroll-component.index')->with(['success' => 'Component Berhasil Dibuat!']);
    }

    public function edit($id)
    {
        $component = PayrollComponent::find($id);
        return view('pages.payroll-component.edit',compact('component'));
    }

    public function update(Request $request, $id)
    {
        try {
            $component = PayrollComponent::find($id);
            $component->nama_komponen = $request->nama_komponen;
            $component->jenis = $request->jenis;
            $component->save();

            return redirect()->route('payroll-component.index')->with('success', 'Data Komponen Berhasil Diupdate.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        }
    }

    public function destroy($id)
    {
        $component = PayrollComponent::find($id);
        $component->delete();

        return redirect()->route('payroll-component.index')->with('success', 'Data berhasil dihapus.');
    }
}
