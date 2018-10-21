<?php

namespace App\Http\Controllers;

use App\Inventario;
use App\Producto;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $productos =Producto::all()->where("nombre","!=","Otros");
        return view("productos.productos",['productos' => $productos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }


    public function show_comple_prod($nomb_prod)
    {

        $id_empresa = Auth::user()->id_establecimiento;
       // $response =Producto::select('nombre','id')->where('nombre','like','%'.$nomb_prod.'%')->get();
       // $response =Producto::with(["inventario","inventario.bodega"])->where('nombre','like','%'.$nomb_prod.'%')->get();
            $response =Producto::with(["inventario.bodega", "inventario"])->where([['nombre','like','%'.$nomb_prod.'%'],
                ["id_establecimiento","=",$id_empresa]])
                ->get();
       echo json_encode($response);
        //return view("/home");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
