@extends('layouts.plantilla')

    @section('contenido')

        <h1>Catálogo de productos</h1>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">

            @foreach($productos as $producto)

                <div class="col">
                    <div class="card my-3">
                        <img src="/productos/{{ $producto->prdImagen }}" class="card-img-top img-thumbnail">
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->prdNombre }}</h5>
                            <p class="card-text">
                                Marca: {{ $producto->getMarca->mkNombre }}<br>
                                Categoria: {{ $producto->getCategoria->catNombre }}<br>
                                Precio: $ {{ $producto->prdPrecio }}<br>
                                Presentación: {{ $producto->prdPresentacion }}
                            </p>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>
        {{ $productos->links() }}

    @endsection

