@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-11">
        <form method="POST" action="/admin/role/store" style="width: 75%;" enctype="multipart/form-data">
          @csrf
        <h1>Create New Role</h1>

        <div class="mb-3">
          <label for="title" class="form-label">Role Name</label>
          <input type="text" class="form-control" id="name" name="name">
        </div>

        <!--<div class="mb-3">
          <label for="grant_title" class="form-label">Grant Title?</label>
          <input type="checkbox" class="form-check-input" id="grant_title" name="grant_title">
        </div>

        <div class="mb-3" id="title-container" style="display: none;">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" name="title">
        </div>

        <div class="mb-3">
          <label for="grant_badge" class="form-label">Grant Badge?</label>
          <input type="checkbox" class="form-check-input" id="grant_badge" name="grant_badge">
        </div>

        <div class="mb-3" id="badge-container" style="display: none;">
          <label for="badge" class="form-label">Badge Image</label>
          <input type="file" class="form-control" id="badge" name="badge">
        </div>

        <div class="mb-3">
          <label for="unlock_item" class="form-label">Unlock Shop Item?</label>
          <input type="checkbox" class="form-check-input" id="unlock_item" name="unlock_item">
        </div>

        <div class="mb-3" id="choose-item-container" style="display: none;">
          <label for="item_id" class="form-label">Choose Shop Item</label>
          <select name="item_id">
            <option></option>
          </select>
        </div>-->

        <button type="submit" class="btn btn-warning">Create</button>
      </div>

    </div>


  </div>

@endsection
