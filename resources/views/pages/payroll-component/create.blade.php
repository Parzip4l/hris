@extends('layout.master')

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Additional Information</a></li>
    <li class="breadcrumb-item"><a href="#">Payroll</a></li>
    <li class="breadcrumb-item"><a href="#">Payroll Komponen</a></li>
    <li class="breadcrumb-item active" aria-current="page">Buat Komponen</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Buat Komponen</h6>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('payroll-component.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
          <div class="mb-3">
            <label for="exampleInputNumber1" class="form-label">Nama Komponen</label>
            <input type="text" class="form-control" name="nama_komponen" require>
          </div>

          <div class="mb-3">
            <label for="exampleInputNumber1" class="form-label">Jenis Komponen</label>
            <select name="jenis" class="form-control" id="">
                <option value="Allowance">Allowance</option>
                <option value="Deduction">Deduction</option>
            </select>
          </div>

          <button class="btn btn-primary" type="submit">Simpan Data</button>
          <button class="btn btn-danger" type="reset">Reset Data</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
