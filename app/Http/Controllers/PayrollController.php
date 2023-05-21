<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;
use App\Payroll;
use Carbon\Carbon;

class PayrollController extends Controller
{
    public function calculatePayroll()
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            $basicSalary = $employee->salary;
            $allowances = 0; // Hitung tunjangan sesuai kebutuhan Anda
            $deductions = 0; // Hitung potongan sesuai kebutuhan Anda
            $overtimePay = 0; // Hitung pembayaran lembur sesuai kebutuhan Anda
            $takeHomePay = $basicSalary + $allowances - $deductions + $overtimePay;

            $payroll = new Payroll();
            $payroll->nik = $employee->nik;
            $payroll->periode = Carbon::now()->format('Y-m');
            $payroll->basic_salary = $basicSalary;
            $payroll->allowances = $allowances;
            $payroll->deductions = $deductions;
            $payroll->overtimepay = $overtimePay;
            $payroll->takehomepay = $takeHomePay;
            $payroll->payment = 'Paid'; // Status pembayaran, sesuaikan dengan kebutuhan Anda
            $payroll->date = Carbon::now();
            $payroll->save();
        }

        return view('pages.payroll.payroll',compact('payroll'));
    }

    public function storePayroll(Request $request)
    {
        $payroll = new Payroll();
        $payroll->nik = $request->input('nik');
        $payroll->periode = $request->input('periode');
        $payroll->basic_salary = $request->input('basic_salary');
        $payroll->allowances = $request->input('allowances');
        $payroll->deductions = $request->input('deductions');
        $payroll->overtimepay = $request->input('overtimepay');
        $payroll->takehomepay = $request->input('takehomepay');
        $payroll->payment = $request->input('payment'); 
        $payroll->date = $request->input('date');
        $payroll->save();
    }

    public function showPayroll()
    {
        $payrolls = Payroll::all();

        return view('pages.payroll.payroll',compact('payrolls'));
    }
}
