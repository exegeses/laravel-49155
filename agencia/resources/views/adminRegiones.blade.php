@extends('layouts.plantilla')

    @section('contenido')

        <h1>Panel de administración de regiones</h1>


        <table class="table table-borderless table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Región</th>
                    <th colspan="2">
                        <a href="/agregarRegion" class="btn btn-outline-secondary">
                            Agregar
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td>{{ 'regID' }}</td>
                    <td>{{ 'regNombre' }}</td>
                    <td>
                        <a href="/modificarRegion/regID" class="btn btn-outline-secondary">
                            Modificar
                        </a>
                    </td>
                    <td>
                        <a href="/eliminarRegion/regID" class="btn btn-outline-secondary">
                            Eliminar
                        </a>
                    </td>
                </tr>

            </tbody>
        </table>


    @endsection