<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //obtenemos listado de marcas
        $marcas = Marca::paginate(7);
        return view('adminMarcas', [ 'marcas'=>$marcas ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agregarMarca');
    }

    private function validarForm(Request $request)
    {
        $request->validate(
                        [
                            'mkNombre'=>'required|min:2|max:30'
                        ],
                        [
                            'mkNombre.required'=>'El campo "Nombre de la marca" es obligatorio.',
                            'mkNombre.min'=>'El campo "Nombre de la marca" debe tener al menos 2 caractéres.',
                            'mkNombre.max'=>'El campo "Nombre de la marca" debe tener 30 caractéres como máximo.'
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
        //capturamos dato
        $mkNombre = $request->mkNombre;
        //validación
        $this->validarForm($request);
        //instanciación, asignación & guardar
        $Marca = new Marca;
        $Marca->mkNombre = $mkNombre;
        $Marca->save();
        //redirección a admin con mansaje ok
        return redirect('/adminMarcas')
                    ->with([ 'mensaje'=>'Marca: '.$mkNombre.' agregada correctamente.' ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //obtenemos Marca por su id
        $Marca = Marca::find($id);
        return view('modificarMarca', [ 'Marca'=>$Marca ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //validar
        $this->validarForm($request);
        //obtenemos datos de Marca por id
        $Marca = Marca::find($request->idMarca);
        //asigamos atributos
        $Marca->mkNombre = $mkNombre = $request->mkNombre;
        //guardamos
        $Marca->save();
        //redirección a admin con mansaje ok
        return redirect('/adminMarcas')
            ->with([ 'mensaje'=>'Marca: '.$mkNombre.' modificada correctamente.' ]);
    }

    private function productoPorMarca($idMarca)
    {
        //$check = Producto::where('idMarca', $idMarca)->first();
        //$check = Producto::firstWhere('idMarca', $idMarca);
        $check = Producto::where('idMarca', $idMarca)->count();
        return $check;
    }

    public function confirmarBaja($id)
    {
        //obtenemos datos de Marca por su id
        $Marca = Marca::find($id);

        //si NO HAY productos de esa marca
        if ( $this->productoPorMarca($id) == 0 ){
            //retornamos vista de confirmación
            return view('eliminarMarca', [ 'Marca'=>$Marca ]);
        }
        //redirección con mensaje que no se puede eliminar
        return redirect('/adminMarcas')
                ->with(['mensaje'=>'No se puede eliminar la marca: '.$Marca->mkNombre.' ya que tiene productos relacionados.']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Marca::destroy($request->idMarca);
        /*
         * $Marca = Marca::find($request->idMarca);
         * $Marca->delete();
         * */
        //redirección a admin con mansaje ok
        return redirect('/adminMarcas')
            ->with([ 'mensaje'=>'Marca: '.$request->mkNombre.' eliminada correctamente.' ]);
    }
}
