@extends('layouts.tienda-plantilla')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="height: 80vh; background-color: #f5f5f5;">
    <div class="text-center">
        <h1>¡Gracias por tu compra!</h1>
        <p>Hemos enviado un correo con el detalle de tu orden. También puedes revisar tu orden en tu perfil.</p>
        <p>Por cualquier duda, no dudes en contactarnos por correo o teléfono.</p>
        <p>Volviendo a la vista de inicio en <span id="counter">5</span> segundos...</p>
        <a href="{{ url('/') }}" class="btn btn-primary" style="background-color: #f18770; border-color: #f18770;">Volver a la página principal</a>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let counter = 5;
    const countdown = setInterval(() => {
        counter--;
        document.getElementById('counter').innerText = counter;
        if (counter === 0) {
            
            window.location.href = "{{ url('/') }}";
            clearInterval(countdown);
        }
    }, 1000);
</script>
@endsection
