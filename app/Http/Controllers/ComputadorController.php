<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Computadora;
use App\Alumno;
class ComputadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("nuevocomputador");
    }
    public function getComputadoresDisp()
    {
        $computadores = Computadora::Where('alumno_asignado',"=","Ninguno")->get();
        return $computadores;
    }
    public function getComputadores()
    {
        $computadores = Computadora::all();
        return $computadores;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        if($request->nombre == null)
        {
         return response()->json([
             'message' => 'Agrega el nombre del PC!!',
         ]);  
        }
        else{
            $computador = new Computadora;
            $computador->nombre = $request->nombre;
            $computador->alumno_asignado = "Ninguno";
            $computador->aula_destinada ="Ninguna";
            $computador->save();
            $computadores = Computadora::all();
            return response()->json([
                'message' => 'Computador registrado!',
                'lista' => $computadores
            ]);
        }
        
    }
    public function generarReporte()
    {
        $pdf = app('dompdf.wrapper');
    $pdf->loadHTML('<h1>Styde.net</h1>');

    return $pdf->download('mi-archivo.pdf');
    }
    public function asignar(Request $request)
    {
        $computador = Computadora::find($request->id);
        $computador->alumno_asignado = $request->alumno_id;
        
        $computador->save();
        return response()->json([
            'message' => 'Computador asignado al alumno '
        ]);
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
