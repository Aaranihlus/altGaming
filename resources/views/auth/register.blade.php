@extends('layouts.main')

@section('content')

  <div class="container bg-alt-yellow p-4 extra-rounded" style="width: 25%; margin-top: 20vh;">

    <h1 class="text-xl font-bold uppercase">Register</h1>
    <span>You will be able to set up your profile after registration</span>

    <hr>

    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="/register">
      @csrf

      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username">
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="text" class="form-control" id="email" name="email">
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="text" class="form-control" id="password" name="password">
      </div>

      <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input type="text" class="form-control" id="password_confirmation" name="password_confirmation">
      </div>

      <div style="display: flex; align-items: center; justify-content: space-between;">
        <a class="underline text-sm text-alt-yellow hover:text-white" href="/login">
          {{ __('Already registered?') }}
        </a>

        <button type="submit" class="btn btn-warning mx-1">Sign Up</button>
      </div>
    </form>

  </div>

@endsection
