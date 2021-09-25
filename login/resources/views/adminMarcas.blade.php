<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel de adminstración de Marcas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <h1 class="text-2xl">Listado de marcas</h1>

                    @if ( session('mensaje') )
                        <div class="max-w-2xl mx-auto my-12 p-3
                            border border-green-300 bg-green-100 text-green-600 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                            {{ session('mensaje') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-4 gap-2 w-1/2 mx-auto">

        <!-- encabezado -->
                        <div class="border border-gray-100 p-3">
                            id
                        </div>
                        <div class="border border-gray-100 p-3">
                            Marca
                        </div>
                        <div class="border border-gray-100 col-span-2 p-3">
                            <a href="/marca/create"
                                    class="bg-gray-100 border border-gray-300 rounded
                                            text-yellow-600
                                           hover:bg-gray-50 hover:text-yellow-400
                                           px-5 py-1">
                                        Agregar
                            </a>
                        </div>
        <!-- listado -->
            @foreach( $marcas as $marca )
                        <div class="border border-gray-100 p-3">
                            {{ $marca->idMarca }}
                        </div>
                        <div class="border border-gray-100 p-3">
                            {{ $marca->mkNombre }}
                        </div>
                        <div class="border border-gray-100 p-3">
                            <a href="/marca/edit/{{ $marca->idMarca }}"
                               class="bg-gray-100 border border-gray-300 rounded
                                            text-yellow-600
                                           hover:bg-gray-50 hover:text-yellow-400
                                           px-5 py-1">
                                Modificar
                            </a>
                        </div>
                        <div class="border border-gray-100 p-3">
                            <a href="agregarMarca"
                               class="bg-gray-100 border border-gray-300 rounded
                                            text-yellow-600
                                           hover:bg-gray-50 hover:text-yellow-400
                                           px-5 py-1">
                                Eliminar
                            </a>
                        </div>
            @endforeach
        <!-- fin listado -->
                    </div>
                    {{ $marcas->links() }}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
