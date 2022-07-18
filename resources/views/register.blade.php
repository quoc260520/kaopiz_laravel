@extends('layout')
@section('page')
<div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card border-0 shadow rounded-3 my-5">
        <div class="card-body p-4 p-sm-5">
            @if ($message ?? '')
            <div class="alert alert-{{ $messageType ?? 'info' }} mb-5" role="alert">
                {{ $message ?? '' }}
            </div>
            @endif
          <h5 class="card-title text-center mb-5 fw-light fs-5">Sign Up</h5>
          <form method="post" action="">
            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="floatingInput" value="{{ old('email')  }}" placeholder="name@example.com" name="email">
              <label for="floatingInput">Email address</label>
            </div>
            @error('email')
            <p class="text-danger">{{ $message }}</p>
            @enderror
            <div class="form-floating mb-3">
              <input type="password" class="form-control" value="{{ old('password') }}"  id="floatingPassword" placeholder="Password" name="password">
              <label for="floatingPassword">Password</label>
            </div>
            @error('password')
            <p class="text-danger">{{ $message }}</p>
            @enderror

            <div class="form-check mb-3">
              <a class="form-check-label text-dark" href="{{route('login')}}">
                <i>Login</i>
              </a>
            </div>
            <div class="d-grid">
              <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">
                Sign up
              </button>
            </div>
           @csrf
          </form>
        </div>
      </div>
    </div>
</div>
@endsection