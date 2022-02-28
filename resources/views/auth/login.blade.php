@extends('layouts.main')

@section('content')

  <div class="flex-x" style="height: 80vh; align-items: center;">

    <div class="container">

      <div class="row">

        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-alt-yellow p-4 extra-rounded">
          <h1 class="text-xl font-bold uppercase">Welcome back</h1>

          <hr>

          <x-auth-validation-errors class="mb-4" :errors="$errors" />

          <form method="POST" action="/login">
            @csrf

            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username">
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="text" class="form-control" id="password" name="password">
            </div>


            <div style="display: flex; align-items: center; justify-content: space-between;">
              @if (Route::has('password.request'))
                <!--<a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
              </a>-->
            @endif

            <button type="submit" class="btn btn-warning">Log In</button>
          </div>
        </form>
      </div>

      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>

    </div>

  </div>

</div>

@endsection
