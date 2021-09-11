<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::paginate(7);
        return view('adminCategorias', [ 'categorias'=>$categorias ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agregarCategoria');
    }

    private function validarForm(Request $request)
    {
        $request->validate(
            [ 'catNombre'=>'required|min:2|max:50' ],
            [
                'catNombre.required'=>'El campo "Nombre de la categoría" es obligatorio.',
                'catNombre.min'=>'El campo "Nombre de la categoría" debe tener como mínimo 2 caractéres.',
                'catNombre.max'=>'El campo "Nombre de la categoría" debe tener 50 caractéres como máximo.',
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //captura de dato
        $catNombre = $request->catNombre;
        //validación
        $this->validarForm($request);
        //instanciar, asignar, guardar en bbdd
        $Categoria = new Categoria;
        $Categoria->catNombre = $catNombre;
        $Categoria->save();
        //redirección con mensaje ok
        return redirect('/adminCategorias')
            ->with(
                ['mensaje'=>'Categoría: '.$catNombre. ' agregada correctamente.']
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        $Categoria = Categoria::find($id);
        return view('modificarCategoria', [ 'Categoria' => $Categoria ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validarForm($request);
        $Categoria = Categoria::find($request->idCategoria);
        $Categoria->catNombre = $catNombre = $request->catNombre;
        $Categoria->save();
        //redirección con mensaje ok
        return redirect('/adminCategorias')
            ->with(
                ['mensaje'=>'Categoría: '.$catNombre. ' modificada correctamente.']
            );
    }

    private function productoPorMarca($idCategoria)
    {
        $check = Producto::where('idCategoria', $idCategoria)->count();
        return $check;
    }

    public function confirmarBaja($id)
    {
        $Categoria = Categoria::find($id);
        if ( $this->productoPorMarca($id) == 0 ){
            //retornamos vista de confirmación
            return view('eliminarCategoria', [ 'Categoria'=>$Categoria ]);
        }
        return redirect('/adminCategorias')
            ->with(
                    [
                        'mensaje' => 'No se puede eliminar la marcategoria: '.$Categoria->catNombre.' ya que tiene productos relacionados.',
                        'warning' => 'warning'
                    ]
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Categoria::destroy($request->idCategoria);
        return redirect('/adminCategorias')
            ->with(
                ['mensaje'=>'Categoría: '.$request->catNombre. ' eliminada correctamente.']
            );
    }
}
