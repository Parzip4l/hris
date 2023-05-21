<table>
    <thead>
        <tr>
            <th>NIK</th>
            <th>Periode</th>
            <th>Basic Salary</th>
            <th>Allowances</th>
            <th>Deductions</th>
            <th>Overtime Pay</th>
            <th>Take Home Pay</th>
            <th>Payment</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($payrolls as $payroll)
        <tr>
            <td>{{ $payroll->nik }}</td>
            <td>{{ $payroll->periode }}</td>
            <td>{{ $payroll->basic_salary }}</td>
            <td>{{ $payroll->allowances }}</td>
            <td>{{ $payroll->deductions }}</td>
            <td>{{ $payroll->overtimepay }}</td>
            <td>{{ $payroll->takehomepay }}</td>
            <td>{{ $payroll->payment }}</td>
            <td>{{ $payroll->date }}</td>
        </tr>
        @endforeach
    </tbody>
</table>