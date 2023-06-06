<header class="border-bottom">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
                <a class="navbar-brand" href="{{route('home')}}">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"        aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{route('productos.index')}}" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Productos
                        </a>
                        <ul class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
                          <li><a class="dropdown-item" href="{{route('productos.create')}}">Crear Producto</a></li>
                          <li><a class="dropdown-item" href="#">Crear Categoria de Productos</a></li>
                          <li><a class="dropdown-item" href="{{route('productos.index')}}">Todos los Productos</a></li>
                        </ul>
                      </li>
                    <a class="nav-link" href="{{route('blog')}}">Blog</a>
                    <a class="nav-link" href="{{route('nosotros')}}" tabindex="-1" aria-disabled="false">Nosotros</a>
                </div>
            </div   >
            <nav class="navbar navbar-light me-5 bg-dark">
                <form class="container-fluid justify-content-start">
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle me-2" href="{{route('productos.index')}}" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          {{auth()->user()->name}}
                        </a>
                        <ul class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
                          <li><a class="dropdown-item" href="/logout">Cerrar Sesión</a></li>
                        </ul>
                    </li>
                      @endauth
                      @guest
                      <a class="btn btn-secondary" href="/login" role="button">Inciar Sesión</a>
                      @endguest
                </form>
            </nav>
        </div>
    </nav>

</header>