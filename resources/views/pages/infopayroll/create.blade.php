@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/pickr/themes/classic.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Additional Information</a></li>
    <li class="breadcrumb-item"><a href="#">Payroll</a></li>
    <li class="breadcrumb-item"><a href="#">Payroll Component</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create Employee Payroll Component</li>
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
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Form Payroll Komponen Karyawan</h4>
        <form id="signupForm" method="POST" action="{{ route('payroll-info.store') }}" enctype="multipart/form-data">
            @csrf
          <div class="row mb-3">
            <div class="col">
                <label for="name" class="form-label">Nama Karyawan</label>
                <input id="nama_karyawan" class="form-control" name="nama_karyawan" type="text" placeholder="John Doe">
            </div>
            <div class="col-md-4">
                <label for="Ktp" class="form-label">Kode Karyawan</label>
                <input id="karyawan_id" class="form-control" name="karyawan_id" type="number" placeholder="3xxxxxx">
            </div>
            <div class="col-md-4">
                <label for="Ktp" class="form-label">NIK</label>
                <input id="nik" class="form-control" name="nik" type="number" placeholder="3xxxxxx">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
                <label for="kode_karyawan" class="form-label">Jenis Gaji</label>
                <select name="jenis_gaji" id="jenis_gaji" class="form-control">
                    <option value="Monthly">Monthly</option>
                    <option value="Daily">Daily</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Gaji Pokok</label>
                <input class="form-control" name="gaji_pokok"/>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">NPWP</label>
                <input type="number" class="form-control" name="npwp"/>
            </div>
          </div>
          <hr>
          <h5 class="mb-3">Additional</h5>
          <hr>
            <div class="row mb-3">
                <div class="col ">
                    <div class="form-group">
                        <label for="bpjs_tk mb-3" class="form-label">BPJS TK</label>
                        <select class="form-control" id="bpjs_tk" name="is_use_tk">
                            <option value="no">No</option>
                            <option value="yes">Yes</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bpjs_tk mb-3" class="form-label">BPJS Kesehatan</label>
                        <select class="form-control" id="bpjs_ks" name="is_use_ks">
                            <option value="no">No</option>
                            <option value="yes">Yes</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <div class="form-group">
                        <div class="form-group" id="nominal_bpjs_tk" style="display: none;">
                            <label for="nominal" class="form-label">Nominal BPJS TK</label>
                            <input class="form-control" id="nominal" name="tarif_tk"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-group" id="nominal_bpjs_ks" style="display: none;">
                            <label for="nominal" class="form-label">Nominal BPJS KS</label>
                            <input class="form-control" id="nominal_ks" name="tarif_ks"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col ">
                    <div class="form-group">
                        <label for="bpjs_tk mb-3" class="form-label">Tanggungan</label>
                        <select class="form-control" id="jumlah_tanggungan" name="jumlah_tanggungan">
                            <option value="tk">TK</option>
                            <option value="k">K/0</option>
                            <option value="k1">K/1</option>
                            <option value="k2">K/2</option>
                            <option value="k3">K/3</option>
                            <option value="k4">K/4</option>
                            <option value="k5">K/5</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="nominal_tanggungan">
                        <label for="nominal" class="form-label">Nominal Tanggungan</label>
                        <input type="text" class="form-control" id="nominal_tanggungan" name="tanggungan" placeholder="Nominal tanggungan" value="" readonly>
                    </div>
                </div>
            </div>
            <hr>
                <h5 class="mb-3">Allowance</h5>
            <hr>
            <div class="row mb-3">
                <div class="col">
                    <label for="kode_karyawan" class="form-label">Kinerja</label>
                    <input class="form-control" id="kinerja" name="kinerja"/>
                </div>
                <div class="col-md-3">
                    <label for="kode_karyawan" class="form-label">Makan</label>
                    <input class="form-control" id="makan" name="makan"/>
                </div>
                <div class="col-md-3">
                    <label for="kode_karyawan" class="form-label">Lembur</label>
                    <input class="form-control" id="lembur" name="lembur"/>
                </div>
                <div class="col-md-3">
                    <label for="kode_karyawan" class="form-label">Struktural</label>
                    <input class="form-control" id="struktural" name="struktural"/>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="kode_karyawan" class="form-label">Fungsional</label>
                    <input class="form-control" id="fungsional" name="fungsional"/>
                </div>
                <div class="col-md-3">
                    <label for="kode_karyawan" class="form-label">Fasilitas</label>
                    <input class="form-control" id="fasilitas" name="fasilitas"/>
                </div>
                <div class="col-md-3">
                    <label for="kode_karyawan" class="form-label">Prestasi</label>
                    <input class="form-control" id="prestasi" name="prestasi"/>
                </div>
                <div class="col-md-3">
                    <label for="kode_karyawan" class="form-label">Lain-Lain</label>
                    <input class="form-control" id="lain_lain" name="lain_lain"/>
                </div>
            </div>
            <hr>
                <h5 class="mb-3">Deduction</h5>
            <hr>
            <div class="row mb-3">
                <div class="col">
                    <label for="kode_karyawan" class="form-label">Hutang</label>
                    <input class="form-control" id="potonganhutang" name="potonganhutang"/>
                </div>
                <div class="col-md-3">
                    <label for="kode_karyawan" class="form-label">Mess</label>
                    <input class="form-control" id="potonganmess" name="potonganmess"/>
                </div>
                <div class="col-md-3">
                    <label for="kode_karyawan" class="form-label">Potongan Kerja</label>
                    <input class="form-control" id="potongankerja" name="potongankerja"/>
                </div>
                <div class="col-md-3">
                    <label for="kode_karyawan" class="form-label">JHT</label>
                    <input class="form-control" id="jht" name="jht"/>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="kode_karyawan" class="form-label">Pensiun</label>
                    <input class="form-control" id="pensiun" name="pensiun"/>
                </div>
                <div class="col-md-3">
                    <label for="kode_karyawan" class="form-label">Kesehatan</label>
                    <input class="form-control" id="kesehatan" name="kesehatan"/>
                </div>
                <div class="col-md-3">
                    <label for="kode_karyawan" class="form-label">PPH 21</label>
                    <input class="form-control" id="pph21" name="pph21"/>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <label for="kode_karyawan" class="form-label">Take Home Pay</label>
                <input class="form-control" id="takehomepay" name="takehomepay"/>
            </div>
          <button class="btn btn-primary" type="submit" value="Submit">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>  
@endsection

@push('plugin-scripts')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/typeahead-js/typeahead.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/pickr/pickr.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/form-validation.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
  <script src="{{ asset('assets/js/inputmask.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>
  <script src="{{ asset('assets/js/typeahead.js') }}"></script>
  <script src="{{ asset('assets/js/tags-input.js') }}"></script>
  <script src="{{ asset('assets/js/dropzone.js') }}"></script>
  <script src="{{ asset('assets/js/dropify.js') }}"></script>
  <script src="{{ asset('assets/js/pickr.js') }}"></script>
  <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        const bpjsTkSelect = document.getElementById('bpjs_tk');
        const nominalBpjsTk = document.getElementById('nominal_bpjs_tk');

        bpjsTkSelect.addEventListener('change', function() {
            const selectedValue = this.value;

            if (selectedValue === 'yes') {
                nominalBpjsTk.style.display = 'block';
            } else {
                nominalBpjsTk.style.display = 'none';
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const bpjsksSelect = document.getElementById('bpjs_ks');
        const nominalBpjsks = document.getElementById('nominal_bpjs_ks');

        bpjsksSelect.addEventListener('change', function() {
            const selectedValue = this.value;

            if (selectedValue === 'yes') {
                nominalBpjsks.style.display = 'block';
            } else {
                nominalBpjsks.style.display = 'none';
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const jenisTanggunganSelect = document.getElementById('jumlah_tanggungan');
        const nominalTanggunganInput = document.getElementById('nominal_tanggungan');

        jenisTanggunganSelect.addEventListener('change', function() {
            const selectedValue = this.value;

            // Ubah nilai input nominal tanggungan sesuai dengan jenis tanggungan yang dipilih
            if (selectedValue === 'tk') {
                nominalTanggunganInput.value = '0';
            } else if (selectedValue === 'k') {
                nominalTanggunganInput.value = '4500000';
            } else if (selectedValue === 'k1') {
                nominalTanggunganInput.value = '4500000';
            } else if (selectedValue === 'k2') {
                nominalTanggunganInput.value = '9000000';
            } else if (selectedValue === 'k3') {
                nominalTanggunganInput.value = '13500000';
            } else if (selectedValue === 'k4') {
                nominalTanggunganInput.value = '13500000';
            } else {
                nominalTanggunganInput.value = '';
            }
        });
    });
</script>
<script>
  $('#nama_karyawan').autocomplete({
        minLength: 1,
        source: function(request, response){
            $.ajax({
                url: "{{ route('karyawan.autocomplete') }}",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function(data){
                    response($.map(data, function(item){
                        return {
                            id: item.id,
                            nik: item.nik,
                            value: item.value
                        }
                    }));
                }
            });
        },
        select: function(event, ui){
            $('#nama_karyawan').val(ui.item.value);
            $('#karyawan_id').val(ui.item.id);
            $('#nik').val(ui.item.nik);
            return false;
        }
    });
</script>
@endpush