@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-11">
        <h1>Manage Users</h1>

        <table class="table table-hover bg-alt-yellow rounded my-3">
          <thead>
            <tr>
              <th scope="col">Username</th>
              <th>Registration Date</th>
              <th>Roles</th>
              <th>Give Role</th>
              <th>Revoke Role</th>
              <th>Give Achievement</th>
              <th>Remove Achievement</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
            <tr>
                <th scope="row"><span>{{$user->username}}</span></th>
                <td><span>{{ \Carbon\Carbon::parse( $user->created_at )->toDayDateTimeString() }}</span></td>
                <td>
                  @if($user->roles->contains('name', 'Admin'))<span>Admin</span>@endif
                  @if($user->roles->contains('name', 'Content Creator'))<span>Content Creator</span>@endif
                  @if($user->roles->contains('name', 'Event Organiser'))<span>Event Organiser</span>@endif
                </td>

                <td>
                  <div class="flex-x">
                    <select class="form-select role-select" style="width: 25%; margin-right: 3px;">
                      <option></option>
                      @foreach($roles as $role)
                        @if(!$user->roles->contains('id', $role->id))
                          <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endif
                      @endforeach
                    </select>
                    <button type="button" class="btn btn-warning grant-role-button ml-2" data-id="{{ $user->id }}">Grant</button>
                  </div>
                </td>

                <td>
                  <div class="flex-x">
                    <select class="form-select role-select" style="width: 25%; margin-right: 3px;">
                      <option></option>
                      @foreach($user->roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                      @endforeach
                    </select>
                    <button type="button" class="btn btn-warning revoke-role-button ml-2" data-id="{{ $user->id }}">Revoke</button>
                  </div>
                </td>

                <td>
                  <div class="flex-x">
                    <select class="form-select achievement-select" style="width: 25%; margin-right: 3px;">
                      <option></option>
                      @foreach($achievements as $achievement)
                        <option value="{{ $achievement->id }}">{{ $achievement->name }}</option>
                      @endforeach
                    </select>
                    <button type="button" class="btn btn-warning grant-achievement-button ml-2" data-id="{{ $user->id }}">Grant</button>
                  </div>
                </td>

                <td>
                  <div class="flex-x">
                    <select class="form-select achievement-select" style="width: 25%; margin-right: 3px;">
                      <option></option>
                      @foreach($user->achievements as $achievement)
                        <option value="{{ $achievement->id }}">{{ $achievement->name }}</option>
                      @endforeach
                    </select>
                    <button type="button" class="btn btn-warning revoke-achievement-button ml-2" data-id="{{ $user->id }}">Revoke</button>
                  </div>
                </td>

                <td>
                  <button type="button" class="btn btn-warning"><a class="link-dark" href="/profile/{{ $user->slug }}">Profile</a></button>
                  <button type="button" class="btn btn-warning ban-user-button" data-id="{{ $user->id }}">Ban</button>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>

    </div>

  </div>

@endsection
