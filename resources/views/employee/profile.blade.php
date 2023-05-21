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
<div class="profile-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h6>My Profile</h6>
                    </div>
                    <div class="accordion p-4" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Info Personal
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                @foreach ($datakaryawan as $data)
                                    <div class="form-group mb-2">
                                        <h6 class="mb-1">Nama Lengkap</h6>
                                        <p class="text-muted">{{$data->nama}}</p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <h6 class="mb-1">Email</h6>
                                        <p class="text-muted">{{$data->email}}</p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <h6 class="mb-1">Jenis Kelamin</h6>
                                        <p class="text-muted">{{$data->jenis_kelamin}}</p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <h6 class="mb-1">Tempat Lahir</h6>
                                        <p class="text-muted">{{$data->tempat_lahir}}</p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <h6 class="mb-1">Tanggal Lahir</h6>
                                        <p class="text-muted">{{$data->tanggal_lahir}}</p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <h6 class="mb-1">Nomor Telepon</h6>
                                        <p class="text-muted">0{{$data->telepon}}</p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <h6 class="mb-1">Status Pernikahan</h6>
                                        <p class="text-muted">{{$data->status_pernikahan}}</p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <h6 class="mb-1">Agama</h6>
                                        <p class="text-muted">{{$data->agama}}</p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <h6 class="mb-1">ID Number</h6>
                                        <p class="text-muted">{{$data->ktp}}</p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <h6 class="mb-1">Alamat</h6>
                                        <p class="text-muted">{{$data->alamat}}</p>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Info Pekerjaan
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="form-group mb-2">
                                        <h6 class="mb-1">ID Karyawan</h6>
                                        <p class="text-muted">{{ $data->nik }}</p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <h6 class="mb-1">Barcode</h6>
                                        <p class="text-muted">-</p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <h6 class="mb-1">Nama Perusahaan</h6>
                                        <p class="text-muted">PT. Indolumas Grease</p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <h6 class="mb-1">Nama Organisasi</h6>
                                        <p class="text-muted">{{$data->organisasi}}</p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <h6 class="mb-1">Posisi Pekerjaan</h6>
                                        <p class="text-muted">{{$data->jabatan}}</p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <h6 class="mb-1">Status Pekerjaan</h6>
                                        <p class="text-muted">{{$data->status_kontrak}}</p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <h6 class="mb-1">Tanggal Bergabung</h6>
                                        <p class="text-muted">{{$data->joindate}}</p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <h6 class="mb-1">Masa Berakhir Kontrak</h6>
                                        <p class="text-muted">{{$data->berakhirkontrak}}</p>
                                    </div>
                                    <div class="form-group mb-2">
                                    @php
                                        use Carbon\Carbon;
                                        $joinDate = \Carbon\Carbon::parse($data->joindate);
                                        $now = \Carbon\Carbon::now();
                                        $masaKerja = $joinDate->diff($now)->format('%y tahun, %m bulan, %d hari');
                                    @endphp
                                        <h6 class="mb-1">Masa Kerja</h6>
                                        <p class="text-muted">{{$masaKerja}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Info Keluarga
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    No Data Found
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                    Pendidikan & Pengalaman
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    No Data Found
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse3">
                                    Skill & Spesialis
                                </button>
                            </h2>
                            <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    No Data Found
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('logout') }}" method="POST" class="mt-2">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100">Logout</button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
