
<header class="border-bottom">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
                <a class="navbar-brand" href="#">Tienda de Pasteles</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"        aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="{{ route('tienda.index') }}">Home</a>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Productos
                        </a>
                        <ul class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
                          <li><a class="dropdown-item" href="#">Crear Producto</a></li>
                          <li><a class="dropdown-item" href="#">Crear Categoria de Productos</a></li>
                          <li><a class="dropdown-item" href="#">Todos los Productos</a></li>
                        </ul>
                      </li>
                    <a class="nav-link" href="#">Blog</a>
                    <a class="nav-link" href="#" tabindex="-1" aria-disabled="false">Nosotros</a>
                </div>
            </div   >
            <nav class="navbar navbar-light me-5 bg-dark">
                <form class="container-fluid justify-content-start">
                  
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle me-2" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          {{auth()->user()->name}}
                        </a>
                        <ul class="nav flex-column">
                          <li class="nav-item">
                            <form method="POST" action="#" class="d-inline">
                              @csrf
                              <button type="submit" class="nav-link btn-link text-white">Logout</button>
                            </form>
                          </li>
                      </ul>
                    </li>
                      @endauth
                      @guest
                      <a class="btn btn-secondary" href="#" role="button">Inciar Sesión</a>
                      @endguest
                </form>
            </nav>
        </div>
    </nav>

</header>

