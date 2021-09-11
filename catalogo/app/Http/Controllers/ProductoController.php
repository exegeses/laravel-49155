<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //obtenemos listado
        $productos = Producto::with(['getMarca', 'getCategoria'])->paginate(6);
        return view('adminProductos', [ 'productos'=>$productos ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //obtener listado de marcas & categorías
        $marcas = Marca::all();
        $categorias = Categoria::all();
        return view('agregarProducto',
                        [
                            'marcas'=>$marcas,
                            'categorias'=>$categorias
                        ]
                );
    }

    private function validarForm(Request $request)
    {
        $request->validate(
                    [
                        'prdNombre' => 'required|min:2|max:30',
                        'prdPrecio' => 'required|numeric|min:0',
                        'idMarca' => 'required',
                        'idCategoria' => 'required',
                        'prdPresentacion' => 'required|min:3|max:150',
                        'prdStock' => 'required|integer|min:1',
                        'prdImagen' => 'mimes:jpg,jpeg,png,gif,svg,webp|max:3072'
                    ],
                    [
                        'prdNombre.required'=>'El campo "Nombre del producto" es obligatorio.',
                        'prdNombre.min'=>'El campo "Nombre del producto" debe tener como mínimo 2 caractéres.',
                        'prdNombre.max'=>'El campo "Nombre" debe tener 30 caractéres como máximo.',
                        'prdPrecio.required'=>'Complete el campo Precio.',
                        'prdPrecio.numeric'=>'Complete el campo Precio con un número.',
                        'prdPrecio.min'=>'Complete el campo Precio con un número positivo.',
                        'idMarca.required'=>'Seleccione una marca.',
                        'idCategoria.required'=>'Seleccione una categoría.',
                        'prdPresentacion.required'=>'Complete el campo Presentación.',
                        'prdPresentacion.min'=>'Complete el campo Presentación con al menos 3 caractéres',
                        'prdPresentacion.max'=>'Complete el campo Presentación con 150 caractérescomo máxino.',
                        'prdStock.required'=>'Complete el campo Stock.',
                        'prdStock.integer'=>'Complete el campo Stock con un número entero.',
                        'prdStock.min'=>'Complete el campo Stock con un número positivo.',
                        'prdImagen.mimes'=>'Debe ser una imagen.',
                        'prdImagen.max'=>'Debe ser una imagen de 3MB como máximo.'
                    ]
        );
    }

    private function subirImagen(Request $request)
    {
        //si no emviaron imagen
        $prdImagen = 'noDisponible.jpg';

        //si enviaron imagen
        if( $request->file('prdImagen') ){
            //renombrar
                //time() . extension
            $extension = $request->file('prdImagen')->extension();
            $prdImagen = time().'.'.$extension;
            //subir archivo
            $request->file('prdImagen')
                        ->move( public_path('productos/'), $prdImagen );
        }

        return $prdImagen;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validar
        $this->validarForm($request);
        //subir imagen*
        $prdImagen = $this->subirImagen($request);
        //instanciar, asignar, guardar
        $Producto = new Producto;
        $Producto->prdNombre = $prdNombre = $request->prdNombre;
        $Producto->prdPrecio = $request->prdPrecio;
        $Producto->idMarca = $request->idMarca;
        $Producto->idCategoria = $request->idCategoria;
        $Producto->prdPresentacion = $request->prdPresentacion;
        $Producto->prdStock = $request->prdStock;
        $Producto->prdImagen = $prdImagen;
        $Producto->save();
        //redirección + mensaje ok
        return redirect('adminProductos')
                    ->with([ 'mensaje'=>'Producto: '. $prdNombre. ' agregado correctamente.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Producto = Producto::find($id);
        $marcas = Marca::all();
        $categorias = Categoria::all();
        return view('modificarProducto',
                        [
                            'Producto'=>$Producto,
                            'marcas'=>$marcas,
                            'categorias'=>$categorias
                        ]
                    );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validarForm($request);
        $Producto = Producto::find( $request->idProducto );
        $Producto->prdNombre = $prdNombre = $request->prdNombre;
        $Producto->prdPrecio = $request->prdPrecio;
        $Producto->idMarca = $request->idMarca;
        $Producto->idCategoria = $request->idCategoria;
        $Producto->prdPresentacion = $request->prdPresentacion;
        $Producto->prdStock = $request->prdStock;
        //subir imagen *
        if( $request->file('prdImagen') ){
            $Producto->prdImagen = $this->subirImagen($request);
        }
        //guardamos
        $Producto->save();
        return redirect('adminProductos')
            ->with([ 'mensaje'=>'Producto: '. $prdNombre. ' modificado correctamente.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
