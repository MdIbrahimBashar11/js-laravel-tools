<nav class="navbar navbar-expand-xl">
    <div class="container h-100">
        <a class="navbar-brand" href="{{ url('/redirect')}}">
            <h1 class="tm-site-title mb-0">Blog Admin</h1>
        </a>
        <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars tm-nav-icon"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto h-100">
                <li class="nav-item">
                    <a class="nav-link " href="{{ url('/redirect')}}">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/addblogpage')}}">
                        <i class="fas fa-shopping-cart"></i>
                        Add Blog
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{url('/blog')}}">
                        <i class="far fa-user"></i>
                         Blog
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/settings')}}">
                        <i class="fas fa-angle-down"></i>
                        Settings
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    Admin, <b>    <form method="POST" action="{{ route('logout') }}">
                      @csrf
    
                      <x-dropdown-link :href="route('logout')" 
                      onclick="return confirm('You are Suru Log Out')"
                              onclick="event.preventDefault();
                                          this.closest('form').submit();">
                          {{ __('Log Out') }}
                      </x-dropdown-link>
                  </form></b>
                </li>
              </ul>
        </div>
    </div>

</nav>