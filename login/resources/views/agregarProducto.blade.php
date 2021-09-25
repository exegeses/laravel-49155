<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Administración de productos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>Alta de un nuevo producto</h1>

    <!-- formulario -->
                    <div class="shadow-md rounded-md mx-auto max-w-3xl mb-72">
                    <form action="/producto/store" method="post">
                    @csrf
                            <div class="p-6 bg-white">
                                <label for="prdNombre" class="block text-sm font-medium text-gray-700">
                                    Nombre del producto:
                                </label>
                                <div class="m-2 flex rounded-md shadow-sm">
                                    <input type="text" name="prdNombre"
                                           id="prdNombre" class="focus:ring-yellow-300 focus:border-yellow-300 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                                </div>

                                <label for="prdPrecio" class="block text-sm font-medium text-gray-700">
                                    Precio:
                                </label>
                                <div class="m-2 flex rounded-md shadow-sm">
                                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                    $</span>
                                    <input type="number" name="prdPrecio"  step="0.01"
                                           id="prdPrecio" class="focus:ring-yellow-300 focus:border-yellow-300 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                                </div>

                                <label for="idMarca" class="block text-sm font-medium text-gray-700">
                                    Marca:
                                </label>
                                <div class="m-2 flex rounded-md shadow-sm">
                                    <select name="idMarca" id="idMarca" class="focus:ring-yellow-300 focus:border-yellow-300 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                                        <option value="">Seleccione una marca</option>
                            @foreach( $marcas as $marca )
                                        <option value="{{ $marca->idMarca }}">{{ $marca->mkNombre }}</option>
                            @endforeach
                                    </select>
                                </div>

                                <label for="idCategoria" class="block text-sm font-medium text-gray-700">
                                    Categoría:
                                </label>
                                <div class="m-2 flex rounded-md shadow-sm">
                                    <select name="idCategoria" id="idCategoria" class="focus:ring-yellow-300 focus:border-yellow-300 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                                        <option value="">Seleccione una categoría</option>
                            @foreach( $categorias as $categoria )
                                        <option value="{{ $categoria->idCategoria }}">{{ $categoria->catNombre }}</option>
                            @endforeach
                                    </select>
                                </div>

                                <label for="prdDescripcion" class="block text-sm font-medium text-gray-700">
                                    Descripción:
                                </label>
                                <div class="m-2 flex rounded-md shadow-sm">
                                    <textarea name="prdDescripcion" rows="3"
                                              id="prdDescripcion" class="focus:ring-yellow-300 focus:border-yellow-300 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"></textarea>
                                </div>


                                <div>
                                    <label class="block text-sm font-medium text-gray-700">
                                        Imagen del producto
                                    </label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="prdImagen" class="relative cursor-pointer bg-white rounded-md font-medium text-yellow-600 hover:text-yellow-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-yellow-500">
                                                    <span>Publicar una imagen</span>
                                                    <input id="prdImagen" name="prdImagen" type="file" class="sr-only">
                                                </label>
                                                <p class="pl-1">o drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">
                                                PNG, JPG, GIF, SVG, WEBP hasta 3MB
                                            </p>
                                        </div>
                                    </div>
                                </div>




                                <div class="py-6 flex items-center justify-end">

                                    <button class="text-yellow-900 hover:text-yellow-800
                                        bg-yellow-400 hover:bg-yellow-300 px-5 py-1 mr-6
                                        border border-yellow-500 rounded
                                        ">Agregar producto</button>
                                    <a href="/adminProductos" class="text-yellow-600 hover:text-yellow-500
                                        bg-gray-50 hover:bg-white px-5 py-1
                                        border border-gray-300 rounded
                                        ">Volver a panel de productos</a>

                                </div>

                            </div>
                    </form>
                    </div>

    <!-- FIN formulario -->

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
