@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Additional Information</a></li>
    <li class="breadcrumb-item active" aria-current="page">Employees</li>
  </ol>
</nav>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif  

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="head-card d-flex justify-content-between mb-3">
            <h6 class="card-title align-self-center mb-0">Payroll Komponen</h6>
            <a class="btn btn-primary d-flex align-items-center" href="{{ route('payroll-component.create') }}"><i data-feather="plus" class="icon-sm me-2"></i> <span class="">Buat Komponen</span></a>
        </div>
        <hr>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama Komponen</th>
                <th>Jenis</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
                @php 
                    $no = 1;
                @endphp
                @foreach ($payrollComponents as $data)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->nama_komponen }}</td>
                <td>{{ $data->jenis }}</td>
                <td>
                    <div class="dropdown">
                    <button class="btn btn-link p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item d-flex align-items-center" href="{{ route('payroll-component.edit', $data->id) }}"><i data-feather="git-branch" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="{{ route('payroll-component.show', $data->id) }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View Detail</span></a>
                      <form action="{{ route('payroll-component.destroy', $data->id) }}" method="POST" id="delete_warga">
                      @csrf
                      @method('DELETE')
                        <a class="dropdown-item d-flex align-items-center" href="#" onClick="hapusForm()"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                      </form>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush