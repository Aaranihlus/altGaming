<nav class="navbar bg-alt-yellow navbar-expand-lg navbar-dark" style="display: flex; justify-content: space-between; height: 8vh; max-height: 8vh;">

  <div style="height: 100%;">
    <a href="/"><img src="/images/logo.png" class="img-fluid mx-2 p-1" alt="Owlie Logo" style="height: 100%;"></a>
  </div>

  <div id="navigation" class="d-none d-lg-block">
    <ul class="nav" style="align-items: center;">

      <li class="anim nav-item me-4"><a href="/">Home</a></li>
      <li class="anim nav-item me-4"><a href="/altlan">altLAN</a></li>
      <li class="anim nav-item me-4"><a href="/blog">Blog</a></li>
      <li class="anim nav-item me-4"><a href="/podcast">Podcast</a></li>
      <li class="anim nav-item me-4"><a href="/events">Events</a></li>
      <li class="anim nav-item me-4"><a href="/shop/all">Shop</a></li>

      @auth
        <li class="anim nav-item me-4"><a href="/cart"><i class="fas fa-shopping-cart"></i> <span id="cart_total_items">{{ session()->get('cart_item_qty') }}</span></a></li>

        <li class="nav-item dropdown me-4" style="background: #1d1800; padding: 8px; /*border-radius: 8px; border: 2px solid #ffc107;*/">

          <span class="dropdown-toggle" id="user-actions" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img class="mr-2" style="border-radius: 50%; width: 2vw;" src="https://cdn.discordapp.com/avatars/{{ Auth::user()->id }}/{{ Auth::user()->avatar }}.webp" alt="{{ Auth::user()->username }}#{{ Auth::user()->discriminator }}" />
            {{ Auth::user()->username }}#{{ Auth::user()->discriminator }}
          </span>

          <ul class="dropdown-menu bg-alt-yellow p-2 me-4" aria-labelledby="user-actions" style="background: #1d1800; margin-top: 0px; border-radius: 0px;">
            <li><a href="{{ url('/profile/' . auth()->user()->slug) }}" class="text-md uppercase mt-8">View Profile</a></li>
            <li><a href="/profile/edit" class="text-md uppercase mt-8">Edit Profile</a></li>
            <li><a href="/account" class="text-md uppercase mt-8">Account</a></li>

            {{--@if(auth()->user()->roles->contains('name', 'Admin'))--}}
              <li><a href="/admin" class="text-md uppercase mt-8">Admin</a></li>
            {{--@endif--}}

            <!--<li><a href="/logout" class="text-md uppercase mt-8">Logout</a></li>-->
          </ul>

        </li>
      @else
        <li class="anim nav-item me-4"><a href="/login" class="text-md font-bold uppercase mr-4"><i class="fab fa-discord"></i> Log in</a></li>
        <!--<li class="anim nav-item me-4"><a href="/register" class="text-md font-bold uppercase mr-4">Register</a></li>-->
      @endauth

    </ul>

  </div>

  <div class="d-lg-none mx-4" id="open-mobile-nav-button">
    <p class="py-0 g-0" style="margin-bottom: 0px !important; font-size: x-large;"><i class="fas fa-bars"></i></p>
  </div>

</nav>
