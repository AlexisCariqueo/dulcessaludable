<nav class="navbar navbar-expand-lg navbar-light bg-custom">
    <div class="container">
        <a class="navbar-brand" href="{{ route('tienda.index') }}">Tienda de Pasteles</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('frontend.productos')}}">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('about.index')}}">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile') }}">Mi cuenta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('blog.index') }}">Blog</a>
                </li>
                @auth
                    @if(Auth::user()->role_id == 1)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Panel de Administración</a>
                        </li>
                    @endif
                @endauth
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart.index') }}">
                        <i class="bi bi-cart"></i> Carrito <span class="bi bi-cart-fill">{{ session('cartCount', 0) }}</span>
                    </a>
                </li>
                
                @guest
                    <li class="nav-item">
                        <a class="btn btn-personalizado" href="{{ route('login') }}">Iniciar sesión</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }} ({{ Auth::user()->role_id == 1 ? 'Administrador' : 'Usuario' }})
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<div></div>

<style>
    .bg-custom {
        background-color: #f8cd9d; /* Cambia el color de fondo del menú */
    }

    .bi-cart-fill {
        color: #ef4f4f; /* Cambia el color del ícono del carrito */
    }

    .btn-personalizado {
        background-color: #ef4f4f; /* Aquí pones el color de fondo que quieras */
        color: #010101; /* Aquí pones el color de texto que quieras */
    }

    .btn-personalizado:hover {
        background-color: #ff6666; /* Aquí pones el color de fondo que quieras cuando el mouse esté sobre el botón */
        color: #ffffff; /* Aquí pones el color de texto que quieras cuando el mouse esté sobre el botón */
    }
</style>
