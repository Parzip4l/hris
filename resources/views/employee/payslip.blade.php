@extends('layout.client') @push('plugin-styles')
<link href="{{ asset('css/style.css') }}" rel="stylesheet" /> 
<link href="{{ asset('assets/plugins/owl-carousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/owl-carousel/assets/owl.theme.default.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/animate-css/animate.min.css') }}" rel="stylesheet" />
@endpush 
@section('content')
<div class="header-wrap-mobile">
    <div class="body-header bg-white p-4">
        <div class="container">
            <div class="content-header d-flex justify-content-between">
                <img class="w-30" src="{{ asset('images/logo.png') }}" alt="profile">
            </div>
        </div>
    </div>
</div>
<section class="bgwrap" style="">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    @foreach ($datakaryawan as $data)
                    <div>
                        <img class="wd-70 rounded-circle profile" src="{{ asset('images/' .$data->gambar) }}" alt="profile">
                    </div>
                    <div class="text-nama">
                        <p style="font-weight: 400;" class="mb-1">{{$greeting}}</p>
                        <h5 class="">{{ Auth::user()->name }}</h5>
                        <p style="font-weight: 400;">{{ $data->jabatan }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<div class="filter-wrap">
    <div class="container">
        <div class="row">
            <div class="form-filter-wrap">
                <form method="GET" action="">
                    <h5>Pilih Bulan :</h5>
                    <input type="month" id="bulan" name="bulan" value="{{ old('bulan') }}" class="form-control mt-1">
                    <button type="submit" class="btn btn-warning w-100 mt-1">FILTER</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="profile-wrap mt-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h6 class="text-center">My Payslip</h6>
                    </div>
                    <div class="card-body text-center">
                        <div class="image-notfound d-flex justify-content-center">
                            <img src="{{ asset('images/notfound.png') }}" alt="" class="w-50 mx-center">
                        </div>
                        <h6>Payslip Tidak Ditemukan</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
