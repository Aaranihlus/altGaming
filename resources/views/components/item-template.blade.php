<div class="bg-alt-yellow extra-rounded p-3 flex-y">

  <div class="col">
    <img src='{{ asset($thumbnail) }}' alt="Thumbnail" class="img-fluid rounded" style="width: 100%;">
  </div>

  <div class="col d-flex flex-y" style="justify-content: space-between;">

      <div>
        <h1 style="color: white;">{{ $name }}</h1>
      </div>

      <div>
        <h4>£{{ $price }}</h4>
      </div>

    <div style="display: flex; justify-content: space-between; flex-direction: row; align-items: flex-end;">
      <button type="button" class="btn btn-warning"><a class="link-dark" href="/shop/view/{{ $slug }}">View</a></button>
      <button type="button" class="btn btn-warning add-to-cart" data-id="{{ $id }}">Add To Cart</button>
    </div>

  </div>

</div>
