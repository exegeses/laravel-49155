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

                    <div class="grid grid-cols-4 gap-2 w-1/2 mx-auto">

        <!-- encabezado -->
                        <div class="border border-gray-100 p-3">
                            id
                        </div>
                        <div class="border border-gray-100 p-3">
                            Marca
                        </div>
                        <div class="border border-gray-100 col-span-2 p-3">
                            <a href="agregarMarca"
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
                            <a href="agregarMarca"
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
