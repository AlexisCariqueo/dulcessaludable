<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Área de administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">


    <style>
        .navbar-custom {
            background-color: #9c8686;
        }

        .nav-custom-link {
            background-color: #658eb9;
            color: #ffffff;
            border-radius: 5px;
            padding: 5px 10px;
            margin: 0 5px;
        }

        .nav-custom-link:hover {
            background-color: #0056b3;
            text-decoration: none;
        }

        .sidebar {
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #343a40;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 75px;
            }

            .main-content {
                margin-left: 75px;
            }
        }

        .nav-item {
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Logo</a>
                <div class="d-flex ms-auto">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link nav-custom-link" href="{{ route('tienda.index') }}">Tienda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-custom-link" href="{{ route('blog.index') }}">Blog</a>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    
    @include('headers.admin-header')
    @stack('scripts')
    
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center mt-4 mb-4">© {{ date('Y') }} Tu Tienda de Pasteles. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
