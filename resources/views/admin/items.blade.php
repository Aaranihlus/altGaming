@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-11">
        <h1>Manage Shop Items</h1>
        <div class="flex-x" style="align-items: center;">
          <button class="btn btn-warning" type="button"><a href="/admin/item/create">New Item</a></button>

          @if($filter == "active_only")
            <a href="/admin/items/all" class="mx-3 g-0" style="margin-bottom: 0px;">Show All Items</a>
          @endif

          @if($filter == "all")
            <a href="/admin/items" class="mx-3 g-0" style="margin-bottom: 0px;">Show Active Only</a>
          @endif

        </div>

        <table class="table table-hover bg-alt-yellow rounded my-3">
          <thead>
            <tr>
              <th scope="col">Item</th>
              <th>Price</th>
              <th>Visible</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($items as $item)
                <tr>
                    <th scope="row"><span>{{ $item->name }}</span></th>
                    <th><span>£{{ $item->price }}</span></th>
                    <td><span>{{ $item->visible == 1 ? "Yes" : "No" }}</span></td>
                    <td>
                      <button class="btn btn-warning" type="button"><a href="/admin/item/edit/{{ $item->id }}">Edit</a></button>
                      <button class="btn btn-warning" type="button"><a href="/admin/item/delete/{{ $item->id }}">Delete</a></button>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>

      </div>

    </div>


  </div>

@endsection
