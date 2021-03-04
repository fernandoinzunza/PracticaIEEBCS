<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;
use App\Computadora;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getAlumnos()
    {
        $alumnos = Alumno::all();
        return $alumnos;
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
            'message' => 'Agrega el nombre del alumno!!',
        ]);  
       }
       else{
        $alumno = new Alumno;
        $alumno->nombre = $request->nombre;
        $alumno->save();
        $alumnos = Alumno::all();
        return response()->json([
            'message' => 'Alumno registrado!',
            'lista' => $alumnos
        ]);
       }
        
    }
    public function pcAsignadas(Request $request){
        $id = (string)$request->id;
        $computadoras = Computadora::where("alumno_asignado",$id)->get();
        return $computadoras;
    }
    public function asignarPc(Request $request)
    {
        $computadora = Computadora::find($request->id_pc);
        $computadora->alumno_asignado = $request->alumno_id;
        if($computadora->save())
        {
            return response()->json([
                'message' => 'Se asigno la computadora!' ]);
        }
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
