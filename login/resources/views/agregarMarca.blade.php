<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Administración de marcas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>Alta de una nueva marca</h1>

    <!-- formulario -->
                    <div class="shadow-md rounded-md max-w-3xl mx-auto mb-6">
                    <form action="/marca/store" method="post">
                    @csrf
                            <div class="p-6 bg-white">
                                <label for="mkNombre" class="block text-sm font-medium text-gray-700">
                                    Nombre de la marca
                                </label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="text" name="mkNombre"
                                           value="{{ old('mkNombre') }}"
                                           id="mkNombre" class="focus:ring-yellow-300 focus:border-yellow-300 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                                </div>

                                <div class="py-6 flex items-center justify-end">

                                    <button class="text-yellow-900 hover:text-yellow-800
                                        bg-yellow-400 hover:bg-yellow-300 px-5 py-1 mr-6
                                        border border-yellow-500 rounded
                                        ">Agregar marca</button>
                                    <a href="/adminMarcas" class="text-yellow-600 hover:text-yellow-500
                                        bg-gray-50 hover:bg-white px-5 py-1
                                        border border-gray-300 rounded
                                        ">Volver a panel de marcas</a>

                                </div>

                            </div>
                    </form>


                    </div>

                    @if( $errors->any() )
                        <div class="bg-red-100 border border-red-400 text-red-700 max-w-2xl mx-auto px-4 py-3 rounded">
                            <ul>
                                @foreach( $errors->all() as $error )
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

    <!-- FIN formulario -->

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
