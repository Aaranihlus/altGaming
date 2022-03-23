<div style="display: none; position: fixed; width: 100vw; min-height: 100vh; padding:30px; background: black; opacity: 0.9; top: 0; left: 0;" id="mobile-nav-container">

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
      <a href="{{ url('/profile/' . auth()->user()->slug) }}" class="text-md uppercase mt-8">View Profile</a>
      <li><a href="/profile/edit" class="text-md uppercase mt-8">Edit Profile</a></li>
      <a href="/account" class="text-md uppercase mt-8">Account</a>

      @if(auth()->user()->roles->contains('name', 'Admin'))
        <a href="/admin">Admin</a>
      @endif

      <!--<a href="/logout">Logout</a>-->

    @else
      <a href="/login">Log in</a>
    @endauth

    <hr>

    <div class="flex-x">
      <a href="https://discord.gg/jvgX8r7" class="mx-2"><i class="fab fa-discord"></i></a>
      <a href="https://https://www.facebook.com/altlanuk" class="mx-2"><i class="fab fa-facebook-f"></i></a>
      <a href="#" class="mx-2"><i class="fab fa-instagram-square"></i></a>
      <a href="https://twitter.com/altgaminguk" class="mx-2"><i class="fab fa-twitter"></i></a>
      <a href="#" class="mx-2"><i class="fab fa-youtube"></i></a>
    </div>

  </div>
</div>
