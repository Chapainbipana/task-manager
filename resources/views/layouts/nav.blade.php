<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Task Manager</a>

    <!-- Mobile toggle -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar items -->
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item">
          <a class="nav-link" href="{{route('tasks.index')}}">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Tasks">Tasks</a>
        </li>

        @guest
          <li class="nav-item mt-3">
            <a class="nav-link" href="{{ route('register') }}" id="signup">Sign Up</a>
          </li>
        @endguest

        @auth
          <!-- Profile dropdown -->
          <li class="nav-item dropdown ms-3">
            <button
              class="btn btn-secondary dropdown-toggle d-flex align-items-center justify-content-center rounded-circle"
              id="userDropdown"
              data-bs-toggle="dropdown"
              aria-expanded="false"
              style="width: 45px; height: 45px; padding: 0; border: none;"
            >
              
            </button>

            <ul class="dropdown-menu dropdown-menu-end shadow mt-2" aria-labelledby="userDropdown">
              <li class="px-3 py-2">
                <strong class="d-block">{{ Auth::user()->name }} </strong>
                <span class="text-muted small">{{ Auth::user()->email }}</span>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item" href="{{ url('profile') }}">Edit Profile</a>
              </li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item">Log out</button>
                </form>
              </li>
            </ul>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
