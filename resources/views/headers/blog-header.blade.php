<header>
  <style>
      #intro {
          margin-top: 0;
          background-image: url('{{ asset('storage/tienda/fondo.jpg') }}');
          background-repeat: no-repeat;
          background-size: cover;
          background-color: #f4b5a7;
      }
      .navbar {
          background-color: #ef7c63 !important;
      }
      @media (max-width: 991px) {
          #intro {
              margin-top: 0;
          }
      }

    .btn-personalizado {
        background-color: #ef7c63;
        color: #ffffff;
    }

    .btn-personalizado:hover {
        background-color: #ef7c63;
        color: #ffffff;
    }
  </style>

  <div id="intro" class="p-5 text-center"> 
      <h1 class="mb-3 h2">Blog Saludable</h1>
      <p class="mb-3">Comidas deliciosas y sanas</p>
      <a class="btn btn-personalizado m-2" href="{{ route('blog.recetas') }}">Ultima Receta</a>
      <a class="btn btn-personalizado m-2" href="{{ route('blog.noticias') }}">Revisa nuestras ultimas noticias</a>
  </div>
</header>


    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
      <div class="container-fluid">
        <a class="navbar-brand" target="_blank" href="#">
          <img src="" height="16" alt="" loading="lazy" style="margin-top: -3px;" />
        </a>
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01"
          aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>
        <!-- ... -->
          <div class="collapse navbar-collapse" id="navbarExample01">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item active">
                  <a class="nav-link" aria-current="page" href="{{ route('blog.index') }}">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('blog.recetas') }}">Recetas</a>
              </li>                       
              <li class="nav-item">
                <a class="nav-link" href="{{ route('blog.noticias') }}">Noticias Saludables</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('blog.novedades') }}">Novedades</a>
              </li>
              @auth
                  @if(Auth::user()->role_id == 1)
                      <li class="nav-item">
                          <a class="nav-link" href="{{route('admin.dashboard')}}">Panel de Administración</a>
                      </li>
                  @endif
                  @else               
                  <li class="nav-item ms-auto">
                      <a class="nav-link" href="{{ route('login') }}">Login</a>
                  </li>
              @endauth
            </ul>
            <form class="d-flex" action="{{ route('blog.search') }}" method="GET">
              <input class="form-control me-2" type="search" placeholder="Buscar post" aria-label="Buscar" name="query">
              <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form> 
          </div>
      </div>
    </nav>
</header>
