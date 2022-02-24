<div style="display: none; position: fixed; width: 100vw; height: 100vw; padding:20px; background: black; opacity: 0.8; top: 0; left: 0;" id="mobile-nav-container">

  <p id="close-mobile-nav" style="font-size: xx-large;"><i class="fas fa-times"></i> Close</p>

  <div id="mobile-nav-inner" style="display: flex; flex-direction: column; align-items: center; font-size: xx-large;">
    <a href="/">Home</a>
    <a href="/altlan">altLAN</a>
    <a href="/blog">Blog</a>
    <a href="/podcast">Podcast</a>
    <a href="/events">Events</a>
    <a href="/shop/all">Shop</a>

    @auth
      <a href="/cart">Cart</a>
      <a href="{{ url('/profile/' . auth()->user()->slug) }}" class="text-md uppercase mt-8">Profile</a>
      <a href="/account" class="text-md uppercase mt-8">Account</a>

      @if(auth()->user()->roles->contains('name', 'Admin'))
        <a href="/admin">Admin</a>
      @endif

      <a href="/logout">Logout</a>

    @else
      <a href="/login">Log in</a>
      <a href="/register">Register</a>
    @endauth

  </div>
</div>
