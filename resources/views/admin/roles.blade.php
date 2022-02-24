@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-11">
        <h1>Manage Roles</h1>
        <button class="btn btn-warning" type="button"><a href="/admin/role/create">New Role</a></button>

        <table class="table table-hover bg-alt-yellow rounded my-3">
          <thead>
            <tr>
              <th scope="col">Role</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($roles as $role)
            <tr>
                <th scope="row"><span>{{ $role->name }}</span></th>
                <td>
                  <button type="button" class="btn btn-warning go-to-checkout-button"><a class="link-dark" href="/admin/role/edit/{{ $role->id }}">Edit</a></button>
                  <button type="button" class="btn btn-warning delete-role-button" data-id="{{ $role->id }}">Delete</button>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>

    </div>


  </div>

@endsection
