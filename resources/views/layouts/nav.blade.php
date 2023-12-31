<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="#">URL Shortener</a>
        </li>
      </ul>   
    </div>
    @auth
    <div class="dropdown align-right">
      <a class="dropdown-toggle link-underline-opacity-0 dropdown-link" href="#" id="" data-toggle="dropdown" aria-haspopup="" aria-expanded="">
        {{ auth()->user()->name }}
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <a class="dropdown-item" href="#">{{ auth()->user()->email }}</a>
        <a class="dropdown-item" onclick="document.getElementById('logoutForm').submit();" href="#">Log out</a>
        <form id="logoutForm" action="{{route('logout')}}" method="post">@csrf</form>
      </div>
    </div>   
    @endauth
  </nav>