@extends('layout.master2')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">

  <div class="row w-100 mx-0 auth-page">
    <div class="col-md-8 col-xl-6 mx-auto">
      <div class="card">
        <div class="row">
          <div class="col-md-4 pe-md-0">
            <div class="auth-side-wrapper" style="background-image: url({{ url('https://via.placeholder.com/219x452') }})">

            </div>
          </div>
          <div class="col-md-8 ps-md-0">
            <div class="auth-form-wrapper px-4 py-5">
              <a href="#" class="noble-ui-logo d-block mb-2" style="color:#FFC512!important;">CHAMPOIL<span style="color:#000!important;">INDONESIA</span></a>
              <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>
              <form method="POST" action="{{url('login/proses')}}">
                @csrf
                <div class="mb-3">
                  <label for="userEmail" class="form-label">{{ __('Email') }}</label>
                  <input type="email" class="form-control" id="userEmail" placeholder="Email" name="email">
                </div>
                <div class="mb-3">
                  <label for="userPassword" class="form-label">{{ __('Password') }}</label>
                  <input type="password" class="form-control" id="userPassword" autocomplete="current-password" placeholder="Password" name="password">
                </div>
                <div class="form-check mb-3">
                  <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label class="form-check-label" for="authCheck">
                  {{ __('Remember Me') }}
                  </label>
                </div>
                <div>
                  <button class="btn btn-warning me-2 mb-2 mb-md-0 w-100">LOGIN</button>
                  
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection