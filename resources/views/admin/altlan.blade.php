@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-11">
        <h1>Manage altLAN</h1>
        <button class="btn btn-warning" type="button"><a href="/admin/altlan/create">New AltLan</a></button>

        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($altlans as $altlan)
            <tr>
                <th scope="row"><span>{{$altlan->id}}</span></th>
                <td>
                  <span>View</span>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>

    </div>


  </div>

@endsection
