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
            <div class="head-content d-flex justify-content-between">
                <img class="w-30" src="{{ asset('images/logo.png') }}" alt="profile">
                <h5 class="align-self-center"></h5>
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
<div class="container">
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
</div>
<div class="attendance-wrap mb-4">
    <div class="container">
        <div class="d-md-block col-md-12 col-xl-12 left-wrapper">
            <div class="card rounded">
                <div class="card-body">
                    @foreach ($datakaryawan as $data)
                    @if (Auth::check())
                        @php
                            $user = Auth::user();
                            $today = \Carbon\Carbon::now()->format('Y-m-d');
                            $clockin = \App\Absensi::where('user_id', $user->id)
                                ->whereDate('tanggal', $today)
                                ->first();
                        @endphp
                        @if ($clockin)
                        <h5 class="text-center mb-3">Let's Get To Home !
                        @else
                        <h5 class="text-center mb-3">Let's Get To Work !
                        @endif
                    @endif
                    
                    </h5>
                    @endforeach
                    @if (Auth::check())
                        @php
                            $user = Auth::user();
                            $today = \Carbon\Carbon::now()->format('Y-m-d');
                            $clockin = \App\Absensi::where('user_id', $user->id)
                                ->whereDate('tanggal', $today)
                                ->first();
                        @endphp
                        @if ($clockin)
                        <form action="{{ route('clockout') }}" method="POST" id="form-absen2">
                        @csrf
                            <input type="hidden" name="latitude_out" id="latitude_out">
                            <input type="hidden" name="longitude_out" id="longitude_out">
                            <input type="hidden" name="status" value="H">
                        <button type="submit" class="btn btn-lg btn-danger btn-icon-text mb-2 mb-md-0 w-100" id="btnout">Clock Out
                        </button>
                    </form>
                    @else
                    <form action="{{ route('clockin') }}" method="POST" class="me-1" id="form-absen">
                        @csrf
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">
                            <input type="hidden" name="status" value="H">
                        <a href="#" class="btn btn-lg btn-primary btn-icon-text mb-2 mb-md-0 w-100" id="btn-absen" onClick="formAbsen()">
                            Clock IN</a>
                    </form>
                    @endif
                    @endif
                    <hr>
                    <div class="log-absen-today">
                        <div class="card ">
                            <div class="card-header text-center bg-warning">
                                <h5>Attendance Log</h5>   
                            </div>
                            <div class="card-body">
                                @foreach ($logs as $log)
                                <div class="clock-in-wrap d-flex justify-content-between">
                                    <div class="con">
                                        <h5 class="text-bold mb-1">{{ $log->clock_in }}</h5>
                                        <h6 class="text-muted">{{ date('d M', strtotime($log->tanggal)) }}</h6>
                                    </div>
                                    <div class="ket align-self-center">
                                        <h5 class="mb-1 text-end text-success">CLOCK IN</h5>
                                    </div>
                                </div>
                                <hr>
                                <div class="clock-in-wrap d-flex justify-content-between">
                                @if (isset($log->clock_out) && !empty($log->clock_out))
                                <div class="con">
                                        <h5 class="text-bold mb-1">{{ $log->clock_out}}</h5>
                                        <h6 class="text-muted">{{ date('d M', strtotime($log->tanggal)) }}</h6>
                                    </div>
                                    <div class="ket align-self-center">
                                        <h5 class="mb-1 text-end text-danger">CLOCK OUT</h5>
                                    </div>
                                </div>
                                @else
                                <div class="w-100">
                                    <p class="text-center">Anda Belum Absen Pulang</p>  
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="banner-carousel-wrap mt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="owl-carousel owl-theme owl-basic" id="slider-home">
                    <div class="item">
                        <div class="detail-absen-wrap">
                            <div class="bg-warning p-4 rounded-custom text-center text-white">
                                <div class="bg-white p-2 rounded-50 mb-2">
                                    <img src="{{ asset('images/sick.png') }}" alt="" class="rounded-50">
                                </div>
                                <h4>Sakit</h4>
                                <p><span style="font-size:24px; font-weight:bold;">0 </span>Days</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="detail-absen-wrap">
                            <div class="bg-primary p-4 rounded-custom text-center text-white">
                                <div class="bg-white p-2 rounded-50 mb-2">
                                    <img src="{{ asset('images/izin.png') }}" alt="" class="rounded-50">
                                </div>
                                <h4>Izin</h4>
                                <p><span style="font-size:24px; font-weight:bold;">0 </span>Days</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="detail-absen-wrap">
                            <div class="bg-danger p-4 rounded-custom text-center text-white">
                                <div class="bg-white p-2 rounded-50 mb-2">
                                    <img src="{{ asset('images/absent.png') }}" alt="" class="">
                                </div>
                                <h4>Tidak Absen</h4>
                                <p><span style="font-size:24px; font-weight:bold;">0 </span> Days</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="banner-carousel-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header bg-warning text-center">
                        <h5>Pengumuman</h5>
                    </div>
                    <div class="card-body">
                        @foreach($pengumuman as $data)
                        <div class="item-pengumuman-wrap d-flex justify-content-between">
                            <div class="item-pengumuman">
                                <h5 class="mb-1">{{ $data->judul }}</h5>
                                <p class="text-warning">{{ $data->created_at->format('d M')}}</p>
                            </div>
                            <div class="download-pengumuman align-self-center">
                                <a href="{{ route('pengumuman.download', $data->id) }}" class="btn btn-sm btn-primary">Download File</a>
                            </div>
                        </div>
                        <hr>
                        @endforeach
                        @if ($count == 0)
                        <div class="image-notfound d-flex justify-content-center">
                            <img src="{{ asset('images/notfound.png') }}" alt="" class="w-50 mx-center">
                        </div>
                        <h6 class="text-center">Tidak Ada Pengumuman</h6>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
@endpush

@push('custom-scripts')
<script>
    $(document).ready(function() {
 
        $("#slider-home").owlCarousel({
            slideSpeed : 100,
            paginationSpeed : 400,
            margin:5,
            pagination: false,

            items : 2, 
            itemsDesktop : false,
            itemsDesktopSmall : false,
            itemsTablet: false,
            itemsMobile : false

        });
    });
  </script>
  <script src="{{ asset('assets/js/carousel.js') }}"></script>
  <script>
    $(document).ready(function () {
        // Mengambil data lokasi pengguna saat tombol absen ditekan
        $('#btn-absen').on('click', function () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    // Mengisi nilai hidden input dengan data lokasi pengguna
                    $('#latitude').val(position.coords.latitude);
                    $('#longitude').val(position.coords.longitude);

                    // Mengirim form absen
                    $('#form-absen').submit();
                });
            } else {
                alert('Geolocation tidak didukung oleh browser Anda');
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        // Mengambil data lokasi pengguna saat tombol absen ditekan
        $('#btnout').on('click', function () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    // Mengisi nilai hidden input dengan data lokasi pengguna
                    $('#latitude_out').val(position.coords.latitude);
                    $('#longitude_out').val(position.coords.longitude);

                    // Mengirim form absen
                    $('#form-absen2').submit();
                });
            } else {
                alert('Geolocation tidak didukung oleh browser Anda');
            }
        });
    });
</script>
<script>
    function formAbsen() {
      document.getElementById("btn-absen").submit();
    }
  </script>
@endpush