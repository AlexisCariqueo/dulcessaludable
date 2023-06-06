<div class="sidebar">
    <div class="container-fluid">
        <h2 class="text-white mt-4 mb-4 d-none d-md-block">Administración</h2>
        <ul class="nav flex-column">
            
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="d-none d-md-inline"> Dashboard</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link text-white" data-bs-toggle="collapse" href="#tiendaMenu" role="button" aria-expanded="false" aria-controls="tiendaMenu">
                    <i class="fas fa-store"></i><span class="d-none d-md-inline"> Tienda</span>
                </a>
                <div class="collapse" id="tiendaMenu">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.productos.create') }}"><i class="fas fa-plus"></i><span class="d-none d-md-inline"> Crear producto</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.productos.index') }}"><i class="fas fa-list"></i><span class="d-none d-md-inline"> Lista de productos</span></a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" data-bs-toggle="collapse" href="#OrdenMenu" role="button" aria-expanded="false" aria-controls="OrdenMenu">
                    <i class="bi bi-list-ul"></i><span class="d-none d-md-inline"> Ordenes</span>
                </a>
                <div class="collapse" id="OrdenMenu">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.ordenes.index') }}"><i class="fas fa-list"></i><span class="d-none d-md-inline"> Lista de Ordenes</span></a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" data-bs-toggle="collapse" href="#usuariosMenu" role="button" aria-expanded="false" aria-controls="usuariosMenu">
                    <i class="fas fa-users"></i><span class="d-none d-md-inline"> Usuarios</span>
                </a>
                <div class="collapse" id="usuariosMenu">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.users.create') }}"><i class="fas fa-user-plus"></i><span class="d-none d-md-inline"> Crear usuario</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.users.index') }}"><i class="fas fa-user"></i><span class="d-none d-md-inline"> Lista de usuarios</span></a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" data-bs-toggle="collapse" href="#blogMenu" role="button" aria-expanded="false" aria-controls="blogMenu">
                    <i class="fas fa-blog"></i><span class="d-none d-md-inline"> Blog</span>
                </a>
                <div class="collapse" id="blogMenu">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.blog.create') }}"><i class="fas fa-edit"></i><span class="d-none d-md-inline"> Crear entrada</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.blog.index') }}"><i class="fas fa-list"></i><span class="d-none d-md-inline"> Lista de entradas</span></a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" data-bs-toggle="collapse" href="#categoriasBlogMenu" role="button" aria-expanded="false" aria-controls="categoriasBlogMenu">
                    <i class="fas fa-th-large"></i><span class="d-none d-md-inline"> Categorías Blog</span>
                </a>
                <div class="collapse" id="categoriasBlogMenu">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.categorias-blog.create') }}"><i class="fas fa-plus-square"></i><span class="d-none d-md-inline"> Crear categoría</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.categorias-blog.index') }}"><i class="fas fa-th-list"></i><span class="d-none d-md-inline"> Lista de categorías</span></a>
                        </li>
                    </ul>
                </div>
            </li>
            
        </ul>
    </div>
</div>

<div class="main-content">
    @yield('content')
</div>
