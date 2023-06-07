<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Olivias Panadería & Pastelería Saludable</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />  <!-- Inclusión de Font Awesome -->

        <style>
            body {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
                background-image: url('/storage/tienda/fondo.jpg');
            }
            

            .content-container {
                flex-grow: 1;
            }

            footer {
                margin-top: auto;
                background-color: #f18770;
            }

            .btn-editar {
                background-color: #f18770;
                border-color: #f18770;
            }

            .btn-cambiar {
                background-color: #f18770;
                border-color: #f18770;
            }

            .btn-editar:hover {
                background-color: #f18770;
                border-color: #f18770;
            }

            .btn-cambiar:hover {
                background-color: #f18770;
                border-color: #f18770;
            }

            .btn-agregar{
                background-color: #f18770;
                border-color: #f18770;
            }

            .btn-agregar:hover {
                background-color: #f18770;
                border-color: #f18770;
            }

            .btn-personalizado {
                background-color: #f18770;
                border-color: #f18770;
            }

            .btn-personalizado:hover {
                background-color: #e16a4a;
                border-color: #e16a4a;
            }

            
            .btn-proceder {
                background-color: #f18770;
                border-color: #f18770;
            }

            .btn-proceder:hover {
                background-color: #d86850;
                border-color: #d86850;
            }

            .btn-volver {
                background-color: grey;
                border-color: grey;
            }

            .btn-volver:hover {
                background-color: darkgrey;
                border-color: darkgrey;
            }

            .btn-pagar {
                background-color: #f18770;
                border-color: #f18770;
            }

            .btn-pagar:hover {
                background-color: #d86850;
                border-color: #d86850;
            }

        </style>

    </head>
        
    <body>
        @include('headers.tienda-header')

        <div class="content-container">
            @yield('content')
        </div>

        <footer class="mt-5 py-3">
            @include('footers.tienda-footer')
        </footer>
        @yield('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </body>
</html>

