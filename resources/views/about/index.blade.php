@extends('layouts.tienda-plantilla')

@section('content')

    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2>Nosotros</h2>

                <h3>Compromiso con la salud</h3>
                <p>
                    Olivias Panadería & Pastelería Saludable es un emprendimiento familiar comprometido en ofrecer productos de panadería y pastelería saludables para personas con distintas alergias alimentarias, especialmente para diabéticos y celiacos.
                </p>
                <img src="{{ asset('https://www.clinicalascondes.cl/getattachment/8845c80d-ce94-43c5-9a57-3b35081a5c5d/') }}" alt="Imagen de Compromiso con la Salud">

                <h3>Años de experiencia</h3>
                <p>
                    Con más de 5 años de trayectoria en la industria, hemos adquirido amplios conocimientos y experiencia en la elaboración de productos saludables. Nuestro equipo está comprometido en brindar productos de alta calidad que se adaptan a las necesidades y preferencias de nuestros clientes.
                </p>
                <img src="{{ asset('https://www.hogarmania.com/archivos/201902/sustitutos-saludables-dulces-caseros-668x400x80xX.jpg') }}" alt="Imagen de Años de Experiencia">

                <h3>Misión</h3>
                <p>
                    Nuestra misión es proporcionar productos de panadería y pastelería saludables, elaborados con ingredientes de calidad y respetando las distintas problemáticas de salud de nuestros clientes. Nos comprometemos a utilizar materias primas locales y a personalizar nuestros productos para cada dolencia, ofreciendo opciones deliciosas y seguras para aquellos con necesidades alimentarias especiales.
                </p>
                <img src="{{ asset('https://concepto.de/wp-content/uploads/2015/08/familia-extensa-e1591818033557.jpg') }}" alt="Imagen de Misión">
            </div>
        </div>
    </div>

@endsection
