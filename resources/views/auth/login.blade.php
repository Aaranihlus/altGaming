@extends('layouts.main')

@section('content')

  <div class="flex-x" style="height: 80vh; align-items: center;">

  <div class="container bg-alt-yellow p-4 extra-rounded" style="width: 25%;">

    <h1 class="text-xl font-bold uppercase">Welcome back</h1>

    <hr>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
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

</div>

@endsection
