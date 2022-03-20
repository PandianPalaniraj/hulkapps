@extends('layout.master-mini')
@section('content')

@if(isset(Auth::user()->id))
<script type="text/javascript">
  window.location = '/'  
</script>
@endif

<div class="content-wrapper d-flex align-items-center justify-content-center auth theme-one" style="background-image: url({{ url('assets/images/auth/login_1.jpg') }}); background-size: cover;">
  <div class="row w-100">
    <div class="col-lg-4 mx-auto">
      <div class="auto-form-wrapper">
        <form action="{{ route('login-check') }}" method="POST">

         @if($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
              <button class="close" type="button" data-dismiss="alert">x</button>
              <strong>{{ $message }}</strong>
            </div>
          @endif

          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label class="label">Username</label>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Username" name="email" autocomplete="off">
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-check-circle-outline"></i>
                </span>
              </div>
            </div>
            @if($errors->has('email'))
              <div class="help-block"><strong>{{ $errors->first('email') }}</strong></div>
            @endif
          </div>
          <div class="form-group">
            <label class="label">Password</label>
            <div class="input-group">
              <input type="password" class="form-control" placeholder="*********" name="password">
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-check-circle-outline"></i>
                </span>
              </div>
            </div>
            @if($errors->has('password'))
              <div class="help-block"><strong>{{ $errors->first('password') }}</strong></div>
            @endif
          </div>
          <div class="form-group">
            <button class="btn btn-primary submit-btn btn-block">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection