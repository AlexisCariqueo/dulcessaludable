@extends('layouts.auth-plantilla')
@section('content') 

  <div class="container">
    
    <div class="row justify-content-center">
        <br>
        <div class="col-md-8">
            
            <div class="card">
                
              @include('auth.messages')
                <div class="card-header">Regístrate</div>

                <div class="card-body">
                    
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn mi-boton-personalizado">
                                    Regístrate
                                </button>   
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
  
  <style>
    .mi-boton-personalizado {
        background-color: #f54242; /* Aquí pones el color de fondo que quieras */
        color: white; /* Aquí pones el color de texto que quieras */
    }
    
    .mi-boton-personalizado:hover {
        background-color: #ff6666; /* Aquí pones el color de fondo que quieras cuando el mouse esté sobre el botón */
    }
    </style>
@endsection
