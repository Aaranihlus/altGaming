@props(['errors'])

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
      <p style="color: #842029; font-weight: bold;">Mistakes were made</p>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
    </div>
@endif
