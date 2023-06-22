<div class="container bg-custom">
    <div class="row">
        <div class="col-md-4">
            <h5>Olivias/Saludables</h5>
            <p>123 Calle de Pasteles<br>
            Ciudad de Postres, CP 1234<br>
            Teléfono: +1 (555) 123-4567</p>
        </div>
        <div class="col-md-4">
            <h5>Enlaces útiles</h5>
            <div class="button-group">
                <a class="custom-link" href="{{route('frontend.productos')}}">Productos</a>
                <a class="custom-link" href="{{route('about.index')}}">Nosotros</a>
                <a class="custom-link" href="{{ route('profile') }}">Mi cuenta</a>
            </div>
        </div>
        <div class="col-md-4">
            <h5>Síguenos en</h5>
            <div class="button-group">
                <a class="custom-link" href="#">Facebook</a>
                <a class="custom-link" href="#">Instagram</a>
                <a class="custom-link" href="#">Twitter</a>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-custom {
        background-color: #f18770;
    }

    .button-group {
        display: flex;
        flex-direction: column;
    }

    .custom-link {
        display: block;
        margin-bottom: 10px;
        color:  #565353; 
        text-decoration: none;
        background-color: transparent;
        padding: 0;
        border: none;
        cursor: pointer;
    }
</style>