@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-11">
        <h1>Manage Games</h1>

        <div class="flex-x">
          <input type="text" class="form-control" id="name" name="name" style="width: 200px;">
          <button type="button" class="btn btn-warning mx-3 create-game-button">Create</button>
        </div>

        <hr>

        <table class="table table-hover bg-alt-yellow rounded my-3">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th>Discord ID</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="game-table-body">
            @foreach($games as $game)
            <tr>
                <td><span>{{ $game->name }}</span></td>
                <td><span>{{ $game->discord_id }}</span></td>
                <td><button type="button" class="btn btn-warning mx-3 delete-game-button" data-id="{{ $game->discord_id }}">Delete</button></td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>

    </div>


  </div>

@endsection
